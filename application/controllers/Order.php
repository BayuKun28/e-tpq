<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('transaksi_model');
        $this->load->model('produk_model');
        $this->load->model('order_model');
        $this->load->model('stok_keluar_model');
        // $this->load->library('cart');
        $this->load->helper('form');
    }
    public function index()
    {
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['produk'] = $this->produk_model->get_all_produk();
        $data['nota'] = $this->order_model->getnomornota();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('order/index', $data);
    }

    public function tes()
    {
    }

    public function getprodukscan()
    {
        $bar = $this->input->post('barcode');
        $this->load->model('produk_model', 'produk');
        $cari = $this->produk->getprodukauto($bar)->result();
        echo json_encode($cari);
    }

    function add_to_cart()
    {
        $data = array(
            'id' => $this->input->post('produk_id'),
            'name' => $this->input->post('nama_produk'),
            'price' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'qty' => $this->input->post('qty'),
        );
        $this->cart->insert($data);
        echo $this->show_cart();
    }
    function show_cart()
    {
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            if ($items['qty'] > $items['stok']) {
                $script =
                    "
                        <script>
                        Swal.fire({
                          icon: 'error',
                          title: 'Data',
                          text: 'Stok Kurang'
                          })
                          </script>
                          ";
                echo $script;
                // echo "<script> alert('Stok Kurang') </script>" ;

                $data = array(
                    'rowid' => $items['rowid'],
                    'qty'   => $items['stok']
                );
                $this->cart->Update($data);
                echo $this->show_cart();
            } else {
                $output .= '
				<tr>
					<td>' . $items['name'] . '</td>
					<td>' . number_format($items['price']) . '</td>
					<td>' . $items['qty'] . '</td>
					<td>' . number_format($items['subtotal']) . '</td>
					<td><button type="button" id="' . $items['rowid'] . '" class="hapus_cart btn btn-danger btn-sm">Batal</button></td>
				</tr>
			';
            }
        }
        $output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">' . 'Rp ' . number_format($this->cart->total()) . '</th>
                <th hidden> <input type="text" name="sumtotal" id="sumtotal" value="' . $this->cart->total() . '" > </th>
			</tr>

		';
        return $output;
    }
    function load_cart()
    {
        echo $this->show_cart();
    }
    function hapus_cart()
    {
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'qty' => 0,
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }

    public function proses_order()
    {
        $total = $this->cart->total();
        $uangbayar1 = $this->input->post('uangbayar');
        $uangbayar = str_replace(',', '', $uangbayar1);
        $pelanggan = $this->input->post('pelanggan');

        if (($uangbayar < $total) || $total < 1 || $uangbayar < 1) {
            $this->session->set_flashdata('message', 'Uang Kurang');
            redirect('Order');
        } else {
            if ($cart = $this->cart->contents()) {
                $nomornota = $this->order_model->getnomornota();
                $data_order = array(
                    'jumlah_uang' => $uangbayar,
                    'nota' => $nomornota,
                    'pelanggan' => $pelanggan,
                    'status' => 1,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'kasir' => $this->session->userdata('id')
                );
                $id_order = $this->order_model->tambah_order($data_order);
                foreach ($cart as $item) {
                    $data_detail = array(
                        'transaksi_id' => $id_order,
                        'produk' => $item['id'],
                        'qty' => $item['qty'],
                        'harga' => $item['price']
                    );
                    $id = $item['id'];
                    $jumlah = $item['qty'];
                    $stok = $this->stok_keluar_model->getStok($id)->stok;
                    $rumus = max($stok - $jumlah, 0);
                    $addStok = $this->stok_keluar_model->addStok($id, $rumus);
                    $proses = $this->order_model->tambah_detail_order($data_detail);
                }
            }
            $this->session->set_flashdata('message', 'Berhasil Belanja');
            $this->cart->destroy();

            redirect('Order/cetak');
        }
    }

    public function cetak()
    {
        $data['produk'] = $this->order_model->getlistnota();
        $data['tanggal'] = date('Y-m-d H:i:s');
        $data['nota'] = $this->order_model->getnotacetak();
        $data['total'] = $this->order_model->totalcetak();
        $bayar = $this->order_model->getbayar();
        $data['bayar'] = $this->order_model->getbayar();
        $totalharga = $this->order_model->totalcetak();
        $data['kembalian'] = $bayar - $totalharga;
        $this->load->view('order/cetak', $data);
    }
    public function menunggu()
    {
        $data['title'] = 'Transaksi Belum Terkonfirmasi';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $xtanggalawal = $this->input->post('tanggalawal');
        $xtanggalakhir = $this->input->post('tanggalakhir');

        if (!empty($xtanggalawal) && !empty($xtanggalakhir)) {
            $xtanggalawal = $this->input->post('tanggalawal');
            $xtanggalakhir = $this->input->post('tanggalakhir');
        } else {
            $xtanggalawal = date('Y/m/d');
            $xtanggalakhir = date('Y/m/d', strtotime('+1 days'));
        }

        $data['tanggalawal'] = $xtanggalawal;
        $data['tanggalakhir'] = $xtanggalakhir;
        $data['penjualan'] = $this->order_model->readmenunggu($xtanggalawal, $xtanggalakhir);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('order/menunggu', $data);
    }
    public function detailmenunggu()
    {
        $data['title'] = 'Detail Order';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $id = $this->uri->segment(3);

        $data['detail'] = $this->order_model->detailmenunggu($id);
        $data['info'] = $this->order_model->infomenunggu($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('order/detailmenunggu', $data);
    }
    public function konfirmasi($id)
    {
        $data = array(
            'status' => 1,
            'kasir' => $this->session->userdata('id')
        );
        $this->db->where('id', $id);
        $this->db->update('transaksi', $data);
        $this->session->set_flashdata('message', 'Berhasil Konfirmasi');
        redirect('Order/menunggu');
    }
    public function cetakkonfirmasi($id)
    {
        $data['detail'] = $this->order_model->detailmenunggu($id);
        $data['info'] = $this->order_model->infomenunggu($id);
        $data['total'] = $this->order_model->totalkonfirmasi($id);
        $this->load->view('order/cetakkonfirmasi', $data);
    }
}

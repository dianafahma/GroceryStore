<?php 

class Dashboard extends CI_Controller {

    public function index()
    {
        $data['barang'] = $this->model_barang->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_ke_keranjang($id)
    {
    	$barang = $this->model_barang->find($id);

    	$data = array(
        	'id'      => $barang->id_sayuran,
       		'qty'     => 1,
        	'price'   => $barang->harga,
        	'name'    => $barang->nama_sayuran
        
	);

	$this->cart->insert($data);
	redirect('dashboard');
    
    }

    public function detail_keranjang()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('keranjang');
        $this->load->view('templates/footer');
     }

    public function hapus_keranjang()
    {
        $this->cart->destroy();
        redirect('dashboard/detail_keranjang');
    }

    public function pembayaran()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pembayaran');
        $this->load->view('templates/footer');
    }

    public function proses_pesanan()
    {
        $is_processed = $this->model_invoice->index();
        if($is_processed){

            $this->cart->destroy();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('proses_pesanan');
            $this->load->view('templates/footer');
        } else{
            echo "Maaf Pesanan Anda Gagal diproses";
        }
    }

    public function detail($id_brg)
    {
        $data['barang'] = $this->model_barang->detail_brg($id_brg);
        $this->load->view('templates/header');
         $this->load->view('templates/sidebar');
        $this->load->view('detail_barang',$data);
        $this->load->view('templates/footer');
    }
}
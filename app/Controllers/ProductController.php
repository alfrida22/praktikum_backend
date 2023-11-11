<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;

class ProductController extends BaseController {
    use ResponseTrait;

    private $product;

    public function __construct(){
        $this->product = new ProductModel();
    }
    
    public function insertProduct(){
        if ($this->request->getMethod() === 'post') {
            $nama_product = $this->request->getVar("nama_product");
            $description = $this->request->getVar("description");
    
            // Lakukan validasi atau operasi lain sesuai kebutuhan
    
            // Setelah validasi atau operasi lainnya, Anda dapat menyimpan data ke database
            $data = [
                'nama_product' => $nama_product,
                'description' => $description
            ];
            $this->product->insertProductORM($data);
    
            // Redirect ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url("products"));
        } else {
            // Jika bukan metode POST, tampilkan formulir
            return view('insert_product');
        }
    }

    public function insertProductApi(){
        $requestData = $this->request->getJSON();
        
        $validation = $this->validate([
            'nama_product' => 'required',
            'description' => 'required',
        ]);

        if (!$validation) {
            $this->response->setStatuscode(400);
            return $this->response->setJSON(
                [
                'code' => 200,
                'status' => "BAD REQUEST",
                'data' => null
                ]
            );
        }
            
        $data = [
            'nama_product' => $requestData->nama_product,
            'description' => $requestData->description
        ];

        $insert = $this->product->insertProductORM($data);
        if ($insert){
            return $this->respond(
                [
                'code' => 200,
                'status' => "OK",
                'data' => $data
            ]
        );
        } else{
            $this->response->setStatuscode(500);
            return $this->response->setJSON(
                [
                    'code' => 500,
                    'status' => "INTERNAL SERVER ERROR",
                    'data' => 'null'
                ]
            );
        }
    }

    public function readProduct(){
        $products = $this->product->findAll();
        $data = [
            'data' => $products
        ];

        return view('product', $data);
    }

    public function readProductApi(){
        $products = $this->product->findAll();

        return $this->respond(
            [
                'code' => 200,
                'status' => "OK",
                'data' => $products
            ]
        );
    }

    public function getProduct($id){
        $product = $this->product->where('id', $id)->first();
        $data = [
            'product' => $product
        ];
        return view('edit_product', $data);
    }

    public function getProductApi($id){
        $product = $this->product->where('id', $id)->first();
       
        if (!$product){
            $this->response->setStatusCode(404);
            return $this->response->setJSON(
                [
                    'code'=> 404,
                    'status'=> 'NOT FOUND',
                    'data'=> 'product not found'
                ]
            );
        }
    
        return $this->respond([
            'code' => 200,
            'status' => "OK",
            'data' => $product
    ]
    );
}
    
    public function updateProduct($id){
        $nama_product = $this->request->getVar('nama_product');
        $description = $this->request->getVar('description');
        $data = [
            'nama_product' => $nama_product,
            'description' => $description
        ];
        $this->product->update($id, $data);
        return redirect()->to(base_url("products"));
    }

    public function updateProductApi($id){
        // Mengambil data JSON dari request
    $requestData = $this->request->getJSON();

    // Melakukan validasi terhadap data yang diterima
    $validation = $this->validate([
        'nama_product' => 'required',
        'description' => 'required'
    ]);

    // Cek apakah validasi berhasil
    if ($validation) {
        // Membuat array data yang akan diupdate
        $data = [
            'nama_product' => $requestData->nama_product,
            'description' => $requestData->description,
        ];

        // Melakukan update data di database menggunakan model
        $this->product->update($id, $data);

        // Mengambil data yang sudah diupdate
        $updatedData = $this->product->find($id);

        // Memberikan response JSON sukses
        return $this->respond([
            'code' => 200,
            'status' => 'OK',
            'data' => $updatedData
        ]);
    } else {
        // Memberikan response JSON untuk kasus validasi gagal
        return $this->respond([
            'code' => 400,
            'status' => 'BAD REQUEST',
            'data' => null
        ]);
    }
    }

    public function deleteProduct($id){
        $this->product->delete($id);
        return redirect()->to(base_url("products"));
    }

    public function deleteProductApi($id){
        // Mencari produk berdasarkan ID
    $product = $this->product->find($id);

    // Jika produk tidak ditemukan, kirim respons 404 Not Found
    if (!$product) {
        return $this->respond([
            'code' => 404,
            'status' => 'NOT FOUND',
            'data' => 'Product not found'
        ]);
    }

    // Melakukan penghapusan produk dari database
    $this->product->delete($id);

    // Kirim respons sukses
    return $this->respond([
        'code' => 200,
        'status' => 'OK',
        'data' => 'Product deleted successfully'
    ]);
    }
}
<?php
class Pos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') == null) {
            redirect('Login');
        } else {
            if ($this->session->userdata('category') == 0) {
                redirect('Skills');
            }
        }

        $this->load->model('Basic_model', 'bm');
        $this->load->model('Main_model', 'mm');
        $this->load->model('Pos_model', 'pdm');
        // $this->load->library('database');
    }

    public function index()
    {
        $data = [
            'title'     =>  'Pos',
            'items'     =>   $this->pdm->getAll('item')
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('pos/index', $data);
        $this->load->view('template/footer');
    }


    public function allCategories()
    {
        $data = [
            'title'     =>  'Pos Categories',
            'cats'     =>   $this->pdm->getAll('pos_category')
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('pos/categories');
        $this->load->view('template/footer');
    }

    public function addCategory()
    {
        $data = [
            'title' =>  "Add Pos Category"
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('pos/addCat');
        $this->load->view('template/footer');
    }

    public function storeCategory()
    {
        $request = $this->input->post();
        $insert = NULL;
        // $this->form_validation->set_rules('name', 'Category Name', 'required|is_unique[pos_category.name]');
        $this->form_validation->set_rules('name', 'Category Name', 'required');
        if ($this->form_validation->run()) {
            $data = [
                'name'              =>  $request['name'],
                'description'       =>  $request['description'],
                'status'            =>  $request['status']
            ];

            if ($request['id'] == 0) {
                $insert = $this->pdm->insert('pos_category', $data);
            } else {
                $insert = $this->pdm->update('pos_category', $data, $request['id']);
            }

            if ($insert == true) {
                $this->session->set_flashdata('success', 'Category Added Successfully');
                $this->allCategories();
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong');
                $this->addCategory();
            }
        } else {
            $this->addCategory();
        }
    }

    public function editCategory($val)
    {
        $data = [
            'title' =>  'Edit Pos Category',
            'row'   =>  $this->pdm->getRow('pos_category', $val)
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('pos/addCat');
        $this->load->view('template/footer');
    }

    public function deleteCategory()
    {
        $request = $this->input->post();
        $this->pdm->delete('pos_category', $request['del']);
        $this->session->set_flashdata('delete', 'Category Deleted Successfully');
        redirect(base_url('pos/categories'));
    }

    public function allProducts()
    {
        $data = [
            'title'     =>     'Pos Products',
            'products'  =>     $this->pdm->getAll('item')
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('pos/products');
        $this->load->view('template/footer');
    }

    public function addProducts()
    {
        $data = [
            'title'     =>     'Create New Pos Product',
            'cats'      =>     $this->pdm->getAll('pos_category')
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('pos/addProducts');
        $this->load->view('template/footer');
    }

    public function storeProduct()
    {
        date_default_timezone_set("Asia/Karachi");
        $request = $this->input->post();
        $image = NULL;
        $opp = NULL;
        $time = date("y-m-d")." ".date('H:i:s');
        $this->form_validation->set_rules('name', 'Product Name', 'required');
        $this->form_validation->set_rules('in_stock', 'Stock', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        if ($this->form_validation->run()) {
            if (empty($_FILES['image']['name'])) {
                $image = '';
            } else {
                $img_name = rand() . '.jpg';
                $config['upload_path'] = 'uploads/product-images';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $img_name;
                $this->load->library('image_lib');
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($request['btn'] == "Update") {
                    if ($_FILES['image']['name'] != "") {
                        unlink('uploads/product-images/' . $request['existing_img']);
                        $this->upload->do_upload('image');
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];
                        $image = $filename;
                    } else {
                        $image = $request['existing_img'];
                    }
                } else if ($request['btn'] == "Add") {
                    $this->upload->do_upload('image');
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $image = $filename;
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url('pos/add-products'));
                }

                $data = [
                    'cat_id'            =>      $request['cat_id'],
                    'name'              =>      $request['name'],
                    'description'       =>      $request['description'],
                    'in_stock'          =>      $request['in_stock'],
                    'quantity'          =>      $request['quantity'],
                    'image'             =>      $image,
                    'price'             =>      $request['price'],
                    'date'              =>      date("Y-m-d"),
                    'time'              =>      date("g:i A",strtotime($time))
        
                ];


                if ($request['btn']  ==  "Add") {
                    $opp = $this->pdm->insert('item', $data);
                } else if ($request['btn'] ==  "Update") {
                    $opp = $this->pdm->update('item', $data, $request['id']);
                }


                if ($opp == true) {
                    if ($request['btn'] == "Add") {
                        $this->session->set_flashdata('success', 'Product Added Successfully');
                        redirect(base_url('pos/products'));
                    } else {
                        $this->session->set_flashdata('success', 'Product Updated Successfully');
                        redirect(base_url('pos/products'));
                    }
                } else {
                    $this->session->set_flashdata('wrong', 'Something Went Wrong');
                    redirect(base_url('pos/add-products'));
                }
            }
        } else {
            $this->addProducts();
        }
    }

    public function editProduct($val)
    {
        $id = hashids_decrypt($val);
        $data = [
            'title'     =>      "Edit Pos Product",
            'row'       =>      $this->pdm->getRow('item', $id),
            'cats'      =>      $this->pdm->getAll('pos_category')
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('pos/addProducts');
        $this->load->view('template/footer');
    }

    public function deleteProduct()
    {
        $request = $this->input->post();
        $this->pdm->delete('item', $request['del']);
        $this->session->set_flashdata('delete', 'Product Deleted Successfully');
        redirect(base_url('pos/products'));
    }


    public function purchaseItem()
    {
        $request = $this->input->post();
        if ($request != NULL) {
            if ($request['category'] == "all") {
                $data = [
                    'title'     =>      'Purchase',
                    'cats'      =>      $this->db->select('*')->from('pos_category')->get()->result(),
                    'items'     =>      $this->db->select('c.name as cat_name,i.*')->from('item as i')
                        ->join('pos_category as c', 'i.cat_id = c.id')
                        ->get()->result()
                ];
            } else {
                $data = [
                    'title'     =>      'Purchase',
                    'cats'      =>      $this->db->select('*')->from('pos_category')->get()->result(),
                    'items'     =>      $this->db->select('c.name as cat_name,i.*')->from('item as i')
                        ->join('pos_category as c', 'i.cat_id = c.id')->where('i.cat_id', $request['category'])
                        ->get()->result()
                ];
            }
        } else {
            $data = [
                'title'     =>      'Purchase',
                'cats'      =>      $this->db->select('*')->from('pos_category')->get()->result(),
                'items'     =>      $this->db->select('c.name as cat_name,i.*')->from('item as i')
                    ->join('pos_category as c', 'i.cat_id = c.id')
                    ->get()->result()
            ];
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('pos/purchase');
        $this->load->view('template/footer');
    }

    public function getItemDetail()
    {
        $request = $this->input->get();
        $row = $this->db->select('*')->from('item')->where('id', $request['item_id'])->get()->row();
        echo json_encode($row);
    }
    public function buyItem()
    {

        $request = $this->input->post();
        // echo "<pre>"; print_r($request); exit;
        $user = ['user' =>   $this->session->userdata()];
        $product_id = $request['item_id'];
        $total_amount = $request['price'] * $request['qty'];
        $user_id = $this->session->userdata('user');
        $remStock  =    $request['stock'] -  $request['qty'];
        $time = date("y-m-d")." ".date('H:i:s');
        $data   =   [
            'user_id'           =>      $user_id,
            'item_id'           =>      $product_id,
            'qty'               =>      $request['qty'],
            'total_amount'      =>      $total_amount,
            'date'              =>      date('Y-m-d'),
            'time'              =>      date("g:i A",strtotime($time))
        ];

        $opp = $this->pdm->insert('purchase', $data);

        if ($opp == true) {
            $this->db->where('id', $product_id)->update('item', ['quantity' => $remStock]);
            $this->load->library('email');
            $view = $this->load->view('email-templates/index', $user, true);


            $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'mail.gbsprojects.xyz',
                'smtp_user' => 'no_reply@gbsprojects.xyz',
                'smtp_pass' => '.h{iG[c48gXx',
                'smtp_port' => '587',
                'charset'   => 'utf-8',
                'wordwrap'  => TRUE,
                'mailtype'  => 'html'
            );
            $this->email->initialize($config);
            $this->email->from('no-repy@taskly.com');
            $this->email->to($this->session->userdata('email'));
            $this->email->subject('Mail from point of sale');
            $this->email->message($view);
            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Thankyou For Purchasing');
                redirect(base_url('pos/my-purchase'));
            } else {
                $this->session->set_flashdata('error', 'This is Temporary Email Error, Your purchase detail saved successfully');
                redirect(base_url('pos/my-purchase'));
            }
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong');
            redirect(base_url('pos/my-purchase'));
        }
    }

    public function totalSell()
    {
        $data = [
            'title'     =>  'Total Sell',
            'sells'     =>   $this->pdm->getAllSell()
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('pos/total-purchase');
        $this->load->view('template/footer');
    }

    public function myPurchase()
    {
        $user_id = $this->session->userdata('user');
        $data = [
            'title'     =>  'My Purchase',
            'items'     =>   $this->pdm->getMyPurchase($user_id)
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('pos/my-purchase');
        $this->load->view('template/footer');
    }
}

<?php 

class ProductController {
    //  hien thi danh sach theo danh muc 
    public function list(){
        $id = $_GET['id']; // lay id cua danh muc
        $product= (new Product)->listProductInCategory($id);
        $category_name = (new Category)->find($id)['cate_name'];
        $categories= (new Category)->all();
        $title = $category_name;
        return view('clients.product.list',
        compact('product','category_name','title','categories' )
    );
    }
    // chi tiết sản phẩm 
    public function show(){
        $id=$_GET['id'];
        $product =(new Product)->find($id);
        $title = $product['name'];
        $categories=(new Category)->all();
         $productReleads= (new Product)->listProductRelead($product['category_id'],$id);
<<<<<<< HEAD

         // Lưu thong tin liên quan 
      $_SESSION['URI'] = $_SERVER['REQUEST_URI'];

        $_SESSION['totalQuantity'] = (new CartController)->totalSumQuantity();
         return view('clients.product.detail',
        compact('product','title','categories','productReleads' )

        
    );
    }
    // danh sách sản phẩm liên quan



    
=======
         return view('clients.product.detail',
        compact('product','title','categories','productReleads' )
    );
    }
    // danh sách sản phẩm liên quan
>>>>>>> 429314e459d02f5fe13ff411b5c5882dacb6eced
   

}
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
         return view('clients.product.detail',
        compact('product','title','categories','productReleads' )
    );
    }
    // danh sách sản phẩm liên quan
   

}
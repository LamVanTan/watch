<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\Images;
use App\Models\Sale;
class AdminProductsController extends Controller
{
	public function __construct(Category $cat,Products $product,Images $img,Sale $sale){
        $this->cat = $cat;
        $this->product = $product;
        $this->img = $img;
        $this->sale = $sale;

    }

    public function index(){
       //$orders = Products::find(13)->images;
        $listProducts = $this->product->getListProducts();
    	return view('admin.products.index',compact('listProducts'));
    }

    public function add(){
    	$listParentId = $this->cat->getListItem();
        $listSale = $this->sale->getListSale();
    	return view('admin.products.add',compact('listParentId','listSale'));
    }

    public function postadd(Request $request){
    	$name = $request->name;
    	$price = $request->price;
    	$quantity = $request->quantity;
    	$status = $request->status;
    	$details = $request->detail;
    	$category = $request->parent_id;
    	$origin = $request->origin;
    	$diameter = $request->diameter;
    	$thickness = $request->thickness;
    	$bracelet = $request->bracelet;
    	$case = $request->case;
    	$crystal = $request->crystal;
    	$machine = $request->machine;
    	$date_products = $request->product_date;
        $sale_id = $request->sale_id;
        if($sale_id == null){
            $sale_id = null;

        }
    	$data = [
    				'products_name'=>$name,
    				'products_price'=>$price,
    				'products_quantity'=>$quantity,
    				'products_status'=>$status,
    				'products_detail'=>$details,
    				'products_origin'=>$origin,
    				'products_diameter'=>$diameter,
    				'products_thickness'=>$thickness,
    				'products_bracelet'=>$bracelet,
    				'products_case'=>$case,
    				'products_crystal'=>$crystal,
    				'products_machine'=>$machine,
    				'products_datetime'=>$date_products,
    				'cat_id' => $category,
                    'sale_id' => $sale_id
				];
    	// kiểm tra có files sẽ xử lý
		if($request->hasFile('photos')) {
			$allowedfileExtension=['jpg','png'];
			$files = $request->file('photos');

            // flag xem có thực hiện lưu DB không. Mặc định là có
			$exe_flg = true;
			// kiểm tra tất cả các files xem có đuôi mở rộng đúng không
			foreach($files as $file) {
				$extension = $file->getClientOriginalExtension();            
				$check=in_array($extension,$allowedfileExtension);

				if(!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
					$exe_flg = false;
					break;
				}
			}

			// nếu không có file nào vi phạm validate thì tiến hành lưu DB
			if($exe_flg) {
                // lưu product
				$productItem = $this->product->addItemProducts($data);
               // duyệt từng ảnh và thực hiện lưu
               $dem = 0;
				foreach ($files as $photo) {
                    $nameFile = $photo->getClientOriginalName();//lay ten anh
                    $explodeFile = explode('.',$nameFile);//tach chuoi anh
                    $ext = end($explodeFile);//lay duoc duoi .jpg
                    $filename = 'watch-'.time().$dem++.'.'.$ext;
                    $photo->move(base_path('storage/app/public/files/'),$filename);
                    $data = [
                                'images_name'=>$filename,
                                'images_status'=>1,
                                'products_id'=>$productItem
                            ];
					$imagesProducts = $this->img->addImages($data);
				}
				return redirect()->route('admin.products.index')->with('msg','Thêm Thành Công');
			} else {
				return redirect()->route('admin.products.add')->with('msg','Sai định dạng file, File phải có đuôi JPG, PNG');
			}	
        }
    }


    public function edit($id){
        $itemProducts = $this->product->getItemProduct($id);
        $listSale = $this->sale->getListSale();
        $listItem = $this->cat->getListItem();
        $resultParent = data_tree($listItem);
        return view('admin.products.edit',compact('itemProducts','listSale','resultParent'));
    }


    public function postedit(Request $request, $products_id){

        $name = $request->name;
        $price = $request->price;
        $quantity = $request->quantity;
        $status = $request->status;
        $details = $request->detail;
        $category = $request->parent_id;
        $origin = $request->origin;
        $diameter = $request->diameter;
        $thickness = $request->thickness;
        $bracelet = $request->bracelet;
        $case = $request->case;
        $crystal = $request->crystal;
        $machine = $request->machine;
        $date_products = $request->product_date;
        $sale_id = $request->sale_id;
        if($sale_id == null){
            $data = [
                    'products_name'=>$name,
                    'products_price'=>$price,
                    'products_quantity'=>$quantity,
                    'products_status'=>$status,
                    'products_detail'=>$details,
                    'products_origin'=>$origin,
                    'products_diameter'=>$diameter,
                    'products_thickness'=>$thickness,
                    'products_bracelet'=>$bracelet,
                    'products_case'=>$case,
                    'products_crystal'=>$crystal,
                    'products_machine'=>$machine,
                    'products_datetime'=>$date_products,
                    'cat_id' => $category,
                    
                ];
        }else{
            $data = [
                        'products_name'=>$name,
                        'products_price'=>$price,
                        'products_quantity'=>$quantity,
                        'products_status'=>$status,
                        'products_detail'=>$details,
                        'products_origin'=>$origin,
                        'products_diameter'=>$diameter,
                        'products_thickness'=>$thickness,
                        'products_bracelet'=>$bracelet,
                        'products_case'=>$case,
                        'products_crystal'=>$crystal,
                        'products_machine'=>$machine,
                        'products_datetime'=>$date_products,
                        'cat_id' => $category,
                        'sale_id' => $sale_id
                    ];
        }

        // kiểm tra có files sẽ xử lý
        if($request->hasFile('photos')) {
                $allowedfileExtension=['jpg','png'];
                $files = $request->file('photos');
                // flag xem có thực hiện lưu DB không. Mặc định là có
                $exe_flg = true;
                // kiểm tra tất cả các files xem có đuôi mở rộng đúng không
                foreach($files as $file) {
                    $extension = $file->getClientOriginalExtension();            
                    $check=in_array($extension,$allowedfileExtension);
                    if(!$check) {
                        // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                        $exe_flg = false;
                        break;
                    }
                }

                // nếu không có file nào vi phạm validate thì tiến hành lưu DB
                if($exe_flg) {  
                    //lưu product
                    $productItem = $this->product->editItemProducts($data,$products_id);
                    // duyệt từng ảnh và thực hiện lưu
                    $dem = 0;
                    foreach ($files as $photo) {
                        $nameFile = $photo->getClientOriginalName();//lay ten anh
                        $explodeFile = explode('.',$nameFile);//tach chuoi anh
                        $ext = end($explodeFile);//lay duoc duoi .jpg
                        $filename = 'watch-'.time().$dem++.'.'.$ext;
                        $photo->move(base_path('storage/app/public/files/'),$filename);
                        $data = [
                                    'images_name'=>$filename,
                                    'images_status'=>1,
                                    'products_id'=>$products_id
                                ];
                        $imagesProducts = $this->img->addImages($data);
                    }
                    return redirect()->route('admin.products.index')->with('msg','Sửa Thành Công');
                }else{
                    
                    return redirect()->back()->with('msg','Sai định dạng file, File phải có đuôi JPG, PNG');
                }   
        }else{
            $product = $this->product->editItemProducts($data,$products_id);
            if($product){
                return redirect()->route('admin.products.index')->with('msg','Sửa Thành Công');
            }else{
                return redirect()->route('admin.products.index')->with('msg','Đã cập nhập');
            }
        } 
    }
    

    public function editpicture(Request $request,$idPic){
        
         // kiểm tra có files sẽ xử lý
        if($request->hasFile('upfile')) {
            $allowedfileExtension=['jpg','png'];
            $files = $request->file('upfile');
            $extension = $files->getClientOriginalExtension();            
            $check=in_array($extension,$allowedfileExtension);
            //flag xem có thực hiện lưu DB không. Mặc định là có
            $exe_flg = true;
                if(!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                    $exe_flg = false;
                }
            
                 if($exe_flg) {
                
                        $nameFile = $files->getClientOriginalName();//lay ten anh
                        $explodeFile = explode('.',$nameFile);//tach chuoi anh
                        $ext = end($explodeFile);//lay duoc duoi .jpg
                        $filename = 'watch-img'.time().'.'.$ext;
                        $files->move(base_path('storage/app/public/files/'),$filename);
                        $data = [
                                    'images_name'=>$filename,
                                ];
                        $imagesProducts = $this->img->editImages($data,$idPic);
                    }
                    return redirect()->back()->with('msg','Cập Nhập Hình Thành Công');
                } else {
                    
                    return redirect()->back()->with('msg','File không tồn tại mong bạn cập nhập lại');
                } 
             
        }


    public function deletepicture($images_id){
        $result = $this->img->deleteItemPicture($images_id);
        if($result){
            return redirect()->back()->with('msg','Xóa hình thành công');
        }else{
            return redirect()->back()->with('msg','Vui lòng thử lại');

        }
    }

    public function delete($products_id){
        $result = $this->product->deleteItemProduct($products_id);
        if($result){
            return redirect()->route('admin.products.index')->with('msg','Xóa Thành Công');
        }else{
            return redirect()->route('admin.products.index')->with('msg','Vui lòng thử lại');

        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
	public function __construct(Category $cat){
        $this->cat = $cat;
    }

    public function index(){
    	$listItem = $this->cat->getListItem();
    	$resultParent = data_tree($listItem);
        //dd($resultParent);
    	return view('admin.category.index',compact('resultParent'));
    }

    public function add(){
    	$listParentId = $this->cat->getListItem();
    	//$resultParent = data_tree($listParentId);
    	return view('admin.category.add',compact('listParentId'));
    }

    public function postadd(Request $request){
    	$name = $request->name;
    	$status = $request->status;
    	$parent_id = $request->parent_id;
    	if($parent_id == null){
    		$parent_id = 0;
    	}
    	
    	$data = [
    				'cat_name' => $name,
    				'cat_status' => $status,
    				'cat_parent_id' => $parent_id
    			];
    	$result = $this->cat->addCategory($data);
    	if($result){
            return redirect()->route('admin.category.index')->with('msg','Thêm Thành Công');
        }else{
            return redirect()->route('admin.category.index')->with('msg','vui long thu lai');

        }

    }

    public function edit($cat_id){
    	$result = $this->cat->getItemEdit($cat_id);
    	$listItem = $this->cat->getListItem();
        $resultParent = data_tree($listItem);
    	return view('admin.category.edit',compact('result','resultParent'));
    }

    public function postedit(Request $request, $cat_id){
    	$name_cat = $request->name_cat;
    	$status = $request->status;
        $parent_id = $request->parent_id;
        if($parent_id == null){
            
            $data = [
                    'cat_name'=>$name_cat,
                    'cat_status'=>$status
                ];
        }else{
            $data = [
                    'cat_name'=>$name_cat,
                    'cat_status'=>$status,
                    'cat_parent_id' => $parent_id
                ];
        }

        
    	
    	$result = $this->cat->editCategory($data,$cat_id);
    	if($result){
            return redirect()->route('admin.category.index')->with('msg','Sua Thành Công');
        }else{
            return redirect()->route('admin.category.index')->with('msg','Cập nhập không thay đổi');

        }

    }

    public function del($cat_id){
    	$result = $this->cat->deleteCategory($cat_id);
    	if($result){
            return redirect()->route('admin.category.index')->with('msg','Xoa Thành Công');
        }else{
            return redirect()->route('admin.category.index')->with('msg','vui long thu lai');

        }
    }


    public function ajax_status_post(Request $request){
        $cat_id = $request->cat_id;
        $status = $request->cat_status;
        if($status == 1){
            $cat_status = 0;
        }else {$cat_status = 1;}
        $data = [
                    'cat_status'=>$cat_status
                ];
        $resultStatus = $this->cat->editCategory($data,$cat_id);
        if($resultStatus){
            $showStatus = $this->cat->getItemAjaxStatus($cat_id);
            $result_cat_status = $showStatus->cat_status;
            if($result_cat_status == 1){
                $background = 'badge badge-success';
                $show = 'show';
              }else{
                $background = 'badge badge-danger';
                $show = 'hide';
            }
            echo "<label class='{$background} ab' title='{$cat_id}-{$cat_status}'>{$show}</label>";
        }
    }
}

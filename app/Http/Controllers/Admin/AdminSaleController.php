<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
class AdminSaleController extends Controller
{

	public function __construct(Sale $sale){
		$this->sale = $sale;
	}

    public function index(){
    	$listSale = $this->sale->getListSale();
    	return view('admin.sale.index',compact('listSale'));
    }

    public function add(){
    	return view('admin.sale.add');
    }

    public function postadd(Request $request){
    	$name = $request->name;
    	$percent = $request->percent;
    	$status = $request->status;
    	$date_start = $request->date_start;
    	$date_end = $request->date_end;

    	$data = [
    				'sale_name'=>$name,
    				'sale_percent'=>$percent,
    				'sale_status'=>$status,
    				'sale_date_start'=>$date_start,
    				'sale_date_end'=>$date_end,
    			];
    	$result = $this->sale->addItemSale($data);
    	if($result){
    		return redirect()->route('admin.sale.index')->with('msg','Thêm Thành Công');
    	}else{
    		return redirect()->route('admin.sale.add')->with('msg','Thêm Mới Thất Bại');
    	}
    }

    public function edit($sale_id){
    	$itemSale = $this->sale->getItemSale($sale_id);
    	return view('admin.sale.edit',compact('itemSale'));
    }

    public function postedit(Request $request, $sale_id){
    	$name = $request->sale_name;
    	$percent = $request->sale_percent;
    	$status = $request->status;
    	$date_start = $request->sale_date_start;
    	$date_end = $request->sale_date_end;

    	$data = [
    				'sale_name'=>$name,
    				'sale_percent'=>$percent,
    				'sale_status'=>$status,
    				'sale_date_start'=>$date_start,
    				'sale_date_end'=>$date_end,
    			];
    	$result = $this->sale->editItemSale($data,$sale_id);
    	if($result){
    		return redirect()->route('admin.sale.index')->with('msg','Sửa Thành Công');
    	}else{
    		return redirect()->back()->with('msg','Sửa Thất Bại');
    	}
    }

    public function delete($sale_id){
    	$result = $this->sale->deleteItemSale($sale_id);
    	if($result){
    		return redirect()->back()->with('msg','Xóa Thành Công');
    	}else{
    		return redirect()->back()->with('msg','Xóa Thất Bại');
    	}
    }
}

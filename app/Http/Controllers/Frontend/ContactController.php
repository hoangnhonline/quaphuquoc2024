<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Contact;


use Helper, File, Session, Auth;

class ContactController extends Controller
{ 
   
    public function store(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[                       
            'full_name' => 'bail|required|min:2|max:100|regex:/^([a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i',
            'email' => 'email|required',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'content' => 'required|min:5|max:1000',
                    
        ],
        [            
            'full_name.required' => 'Bạn chưa nhập họ và tên.',
            'full_name.regex' => 'Tên chỉ bao gồm chữ cái.',
            'full_name.min' => 'Tên quá ngắn.',
            'full_name.max' => 'Tên quá dài.',
            'email.required' => 'Bạn chưa nhập email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'phone.required' => 'Bạn chưa nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
            'content.required' => 'Bạn chưa nhập nội dung.',
            'content.min' => 'Tin nhắn phải dài hơn 10 kí tự.',
            'content.max' => 'Tin nhắn quá dài.'            
        ]);       

        $rs = Contact::create($dataArr);

        Session::flash('message', 'Gửi liên hệ thành công.');

        return redirect()->route('contact');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Repositories\TinhThanhPhoRepository;
use \App\Repositories\DoiTuongChinhSachRepository;
use \App\Repositories\QuanHuyenRepository;
use \App\Repositories\XaPhuongThiTranRepository;
use \App\Repositories\DangKiNhapHocRepository;
use \App\Repositories\HocSinhRepository;
use App\Http\Requests\DangKiNhapHoc\CreateNhapHoc;
use Storage;
use Mail;

class DangKiNhapHocController extends Controller
{

    protected $TinhThanhPho;
    protected $QuanHuyen;
    protected $XaPhuongThiTran;
    protected $DangKiNhapHoc;
    protected $HocSinh;
    protected $DoiTuongChinhSach;

    public function __construct(
        TinhThanhPhoRepository $TinhThanhPho,
        DangKiNhapHocRepository $DangKiNhapHoc,
        QuanHuyenRepository $QuanHuyen,
        XaPhuongThiTranRepository $XaPhuongThiTran,
        HocSinhRepository $HocSinh,
        DoiTuongChinhSachRepository $DoiTuongChinhSach

    ){
        $this->TinhThanhPho = $TinhThanhPho;
        $this->QuanHuyen = $QuanHuyen;
        $this->XaPhuongThiTran = $XaPhuongThiTran;
        $this->DangKiNhapHoc = $DangKiNhapHoc;
        $this->HocSinh = $HocSinh;
        $this->DoiTuongChinhSach = $DoiTuongChinhSach;

    }


    public function index(){
        $doi_tuong_chinh_sach = $this->DoiTuongChinhSach->getAllDoiTuongChinhSach();  
        $thanh_pho = $this->TinhThanhPho->getAllThanhPho();  
        return view('dangki_nhaphoc.index',compact('thanh_pho','doi_tuong_chinh_sach'));
    }

    public function getQuanHuyenByMaTp(Request $request)
    {
        $mapt = $request->matp;
        $thanh_pho = $this->QuanHuyen->getQuanHuyenByMaTp($matp);  
        return $thanh_pho;
    }

    public function getXaPhuongThiTranByMaPh($maph)
    {
        $maph = $request->maph;
        $quan_huyen = $this->XaPhuongThiTran->getXaPhuongThiTranByMaPh($maph);  
        return $quan_huyen;
    }

    public function store(CreateNhapHoc $request){
        $data = $request->all();
        $date_ngay_sinh = $request->ngay_sinh;  
        $data['ngay_sinh'] = date("Y-m-d", strtotime($date_ngay_sinh));  

        if(isset($data['avatar'])){
            $avatar = $request->file("avatar");
            
            if ($avatar) {
                // $pathLoad = Storage::putFile(
                //     'public/uploads/avatar_hs',
                //     $avatar
                // );
                $pathLoad = $avatar->store('public/uploads/avatar');
                $path =  $pathLoad;
                // dd($path);
                // $path = trim($path, 'public/');
                $data['avatar'] = $path;
                // dd($dataRequest['avatar']);
            }


        unset($data['_token']);
        $data['ma_xac_nhan'] = rand(10000, 90000);
        
        $emailNguoiGui = $data['email_dang_ky'];
        $data_email = array('name'=> 'Hhihi','content'=> 'Mã xác thực của bạn là : '.$data['ma_xac_nhan'].', sau 1 phút mã sẽ hết hiệu lực');
        Mail::send('mail', $data_email, function($message) use ($emailNguoiGui) {
            $message->to($emailNguoiGui, 'Tutorials Point')->subject('Nhận mã xác nhận đăng ký');
            $message->from('giacmonghoanmyy@gmail.com','KidsGraden');
        });
        return $this->DangKiNhapHoc->createHocSinhDangKy($data);
        }
    }

    public function XacNhanDangKy(Request $request){
        $ma_xac_thuc = $request->ma_xac_thuc1.$request->ma_xac_thuc2.$request->ma_xac_thuc3.$request->ma_xac_thuc4.$request->ma_xac_thuc5;
        $data =  $this->DangKiNhapHoc->getOneHocSinhDangKy($request->id_form_dang_ky);
        if($data->ma_xac_nhan == $ma_xac_thuc){
            return  $this->DangKiNhapHoc->updateHocSinhDangKy($request->id_form_dang_ky,['status' => 2]);
        }else{
            return 'no';
        }
    }



}

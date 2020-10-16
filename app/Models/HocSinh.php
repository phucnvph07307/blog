<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HocSinh extends Model
{
    protected $table = 'hoc_sinh';
    protected $fillable = [
        'lop_id',
        'ten',
        'gioi_tinh',
        'ten_thuong_goi',
        'avatar',
        'ngay_sinh',
        'noi_sinh',
        'dan_toc',
        'tuoi',
        'ngay_vao_truong',
        'doi_tuong_chinh_sach',
        'hoc_sinh_khuyet_tat',
        'ten_cha',
        'ngay_sinh_cha',
        'cmtnd_cha',
        'dien_thoai_cha',
        'ten_me',
        'ngay_sinh_me',
        'cmtnd_me',
        'dien_thoai_me',
        'dien_thoai_dang_ky',
        'email_dang_ky',
        'ho_khau_thuong_tru_matp',
        'ho_khau_thuong_tru_maqh',
        'ho_khau_thuong_tru_xaid',
        'ho_khau_thuong_tru_so_nha',
        'noi_o_hien_tai_matp',
        'noi_o_hien_tai_maqh',
        'noi_o_hien_tai_xaid',
        'noi_o_hien_tai_so_nha',
    ];
}

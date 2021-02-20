$(document).ready(function(){
    // sembunyikan semua div isi
    $('.isi div').hide();
 
    // tampilkan hanya div isi pada anak pertama
    $('.isi div:first').show();
 
    // saat tombol diklik 
    $('.sc-btn a').click(function(){
 
     // isi attribut class sema tombol dengan nilai ‘non-aktif’
 $('.sc-btn a').attr(‘class’,‘non-aktif’);
 
 // isi attribut class tombol yang sedang aktif dengan nilai ‘aktif’
 $(this).attr(‘class’,‘aktif’);
 
 // buat variabel isi, untuk menampung identitas div isi
 var isi = ‘.isi div[name="’ + this.name + ‘"]';
 
 // sembunyikan semua div isi
 $('.isi div’).hide();
 
 // tampilkan div isi dengan identitas yang telah didapatkan
 $(isi).slideDown(‘fast’);
 
    });
 
});
<?php

namespace Tests\Browser;

use App\Models\Court;
use App\Models\CourtImages;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;

use function PHPUnit\Framework\assertSame;

class BookingTest extends DuskTestCase
{
    // =============== User ===============

    public function test_user_view_a_booking_form(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause('3000')
                ->assertSee('Daftar Lapangan', false)
                ->click('@1_lapangan-1')
                ->assertSee('Pilih hari', false)
                ->screenshot('user/1-view-booking-form')
                ;
        });
    }

    public function test_user_try_book_without_login(): void
    {
        $this->browse(function(Browser $browser) {
            $thisYear = Carbon::now()->format('Y');
            $thisMonth = Carbon::now()->format('m');
            $todayTemp = Carbon::now()->format('d');
            $today = $todayTemp+2;

            $browser->visit('/')
            ->pause('3000')
            ->assertSee('daftar lapangan', true)
            ->click('@1_lapangan-1')
            ->assertSee('pilih hari', true)
            ->type('name', 'Test Book no Login')
            ->keys('#datepick', $thisMonth, $thisYear, $today, '{tab}')
            ->click('#pilih-jadwal')
            ->pause('3000')
            ->check('@test-17')
            ->check('@test-18')
            ->select('payment_metode', 'Bank')
            ->press('#sewa-sekarang')
            ->pause('3000')
            ->assertSee('harap login', true)
            ->screenshot('user/2-user-book-no-login')
            ;
        });
    }

    public function test_user_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
            ->type('email', 'ocel@gmail.com')
            ->type('password', 'ocel123')
            ->click('#login-btn')
            ->assertSee('Login Berhasil')
            ->pause('2000')
            ->screenshot('user/3-user-login')
            ->press('OK')
            ;
        });
    }

    public function test_user_book(): void
    {
        $this->browse(function (Browser $browser) {
            $thisYear = Carbon::now()->format('Y');
            $thisMonth = Carbon::now()->format('m');
            $today = Carbon::now()->format('d');

            $browser->visit('/')
                ->pause('3000')
                ->assertSee('Daftar Lapangan', false)
                ->click('@1_lapangan-1')
                ->assertSee('Pilih hari', false)
                ->type('name', 'Name Test')
                ->keys('#datepick', $thisMonth, $thisYear, $today, '{tab}')
                ->click('#pilih-jadwal')
                ->pause('3000')
                // ->check('@test-17')
                ->check('@test-18')
                ->select('payment_metode', 'Bank')
                ->screenshot('user/4.1-user-booking-lapangan')
                ->pause('2000')
                ->press('#sewa-sekarang')
                ->pause('3000')
                ->assertSee('Booking Berhasil')
                ->screenshot('user/4.2-user-done-booking-lapangan')
                ;
        });
    }

    public function test_user_view_riwayat_pesanan(): void
    {
        $this->browse(function (Browser $browser) {
            $transaction = Transaction::get();
            $browser->visit('/')
            ->pause('3000')
            ->press('#profile-dropdown')
            ->click('#riwayat-pesanan')
            ->assertSee('riwayat pesanan')
            ->screenshot('user/5.1-user-buka-riwayat')
            ;
            if ($transaction->count() < 1) {
                $browser->assertSee('Belum ada transaksi');
            } else {
                $browser->assertSee('ID Pesanan');
            }
            
        });
    }

    public function test_user_view_upload_pembayaran(): void
    {
        $this->browse(function (Browser $browser) {
            $needPayment = Transaction::where('payment_status', 'unpaid')->first();

            $browser->visit('/')
            ->pause('3000')
            ->press('#profile-dropdown')
            ->click('#riwayat-pesanan')
            ->assertSee('riwayat pesanan')
            ;
            
            if ($needPayment == true) {
                $browser
                ->pause('3000')
                ->assertSee('bayar sekarang', true)
                ->assertSee('Upload Bukti Pembayaran', true)
                ->click('#upload-bukti-btn')
                ->assertSee('upload pembayaran', true)
                ->assertSee('Grand Total', true)
                ->screenshot('user/6.1-user-buka-upload-bukti')
                ;
            }
            elseif ($needPayment == false) {
                $browser
                ->pause('3000')
                ->assertSee('ID Pesanan')
                ->assertSee('booking berhasil', true)
                ->screenshot('user/6.2-semua-sudah-dibayar')
                ;
            } 
            else {
                $browser->assertSee('Belum ada transaksi');
            }
        });
    }

    public function test_user_upload_pembayaran(): void
    {
        $this->browse(function (Browser $browser) {
            $needPayment = Transaction::where('payment_status', 'unpaid')->first();
            $transaction = Transaction::where('order_status', 'awaiting_payment')->first();

            $browser->visit('/')
            ->pause('3000')
            ->press('#profile-dropdown')
            ->click('#riwayat-pesanan')
            ->assertSee('riwayat pesanan')
            ;

            if ($needPayment == true) {
                $browser
                ->pause('3000')
                ->assertSee('bayar sekarang', true)
                ->assertSee('Upload Bukti Pembayaran', true)
                ->click('#upload-bukti-btn')
                ->assertSee('upload pembayaran', true)
                ->assertSee('Grand Total', true)
                ->type('pay_amount', $transaction->total)
                ->attach('buktiPembayaran', __DIR__.'/photos/avatar.png')
                ->screenshot('user/7.1-user-upload-bukti')
                ->press('#kirim-bukti')
                ->pause('3000')
                ->screenshot('user/7.2-user-done-upload-bukti')
                ;
            }
            elseif ($needPayment == false) {
                $browser
                ->assertSee('ID Pesanan')
                ->assertSee('booking berhasil', true)
                ->screenshot('user/7.3-all-done')
                ;
            } 
            else {
                $browser->assertSee('Belum ada transaksi');
            }
        });
    }

    public function test_user_logout(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->pause('3000')
            ->press('#profile-dropdown')
            ->click('#btnLogout')
            ->assertSee('logout', true)
            ->pause('2000')
            ->screenshot('user/8.1-user-logout-popup')
            ->press('Yakin')
            ->assertSee('Masuk')
            ->assertSee('Daftar')
            ->screenshot('user/8.2-user-done-logout')
            ;
        });
    }


    // =============== Admin ===============

    public function test_admin_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
            ->type('email', 'admin@gmail.com')
            ->type('password', 'admin123')
            ->click('#login-btn')
            ->assertSee('Login Berhasil')
            ->assertSee('selamat datang di admin panel', true)
            ->pause('2000')
            ->screenshot('admin/1-admin-login')
            ;
        });
    }
    
    public function test_admin_view_dashboard(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->assertSee('dashboard', true)
            ->assertSee('transaksi', true)
            ->assertSee('lapangan', true)
            ->assertSee('pendapatan bulanan', true)
            ->screenshot('admin/1-dashboard/2-admin-view-dashboard')
            ;
        });
    }

    public function test_admin_view_manual_booking_menu(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#booking-manual-menu')
            ->assertSee('Daftar Lapangan', true)
            ->screenshot('admin/3-manual-booking/3.1-open-manual-booking-menu')
            ->click('@2_lapangan-2')
            ->assertSee('Pilih jadwal', true)
            ->assertSee('sewa sekarang', true)
            ->screenshot('admin/3-manual-booking/3.2-open-booking-form')
            ;
        });
    }

    public function test_admin_book_manual_as_admin(): void
    {
        $this->browse(function (Browser $browser) {
            $thisYear = Carbon::now()->format('Y');
            $thisMonth = Carbon::now()->format('m');
            $today = Carbon::now()->format('d');

            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#booking-manual-menu')
            ->assertSee('Daftar Lapangan', true)
            ->click('@2_lapangan-2')
            ->assertSee('Pilih jadwal', true)
            ->type('name', 'Admin Booking Test')
            ->keys('#datepick', $thisMonth, $thisYear, $today, '{tab}')
            ->click('#pilih-jadwal')
            ->pause('3000')
            // ->check('@test-17')
            ->check('@test-18')
            ->select('payment_metode', 'Bank')
            ->screenshot('admin/3-manual-booking/4.1-booking-lapangan')
            ->press('#sewa-sekarang')
            ->pause('3000')
            ->assertSee('Booking Berhasil')
            ->screenshot('admin/3-manual-booking/4.2-done-booking-lapangan')
            ->press('OK')
            ;
        });
    }

    public function test_admin_view_transaction_menu(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#transaksi-menu')
            ->assertSee('transaksi', true)
            ->assertSee('status pembayaran', true)
            ->assertSee('status booking', true)
            ->screenshot('admin/2-transaction/5-admin-view-menu-transaksi')
            ;
        });
    }

    public function test_admin_view_detail_transaction(): void
    {
        $this->browse(function (Browser $browser) {
            $needConfirm = Transaction::where('order_status', 'need_confirm')->first();
            $confirmed = Transaction::where('order_status', 'confirmed')->first();
            $completed = Transaction::where('order_status', 'completed')->first();

            $browser->visit('/admin/dashboard')
            ->click('#transaksi-menu')
            ->assertSee('transaksi', true)
            ->assertSee('status pembayaran', true)
            ->assertSee('status booking', true)
            ;
            
            if ($needConfirm == true) {
                $browser
                ->pause('3000')
                ->assertSee('perlu konfirmasi admin', true)
                ->click('#open-detail-need_confirm')
                ->screenshot('admin/2-transaction/6.1-detail-transaksi-need_confirm')
                ->pause('3000')
                ;
            } else {
                $browser
                ->assertSee('status pembayaran', true)
                ->screenshot('admin/2-transaction/6.1.1-no-transaksi-need_confirm')
                ;
            }
            
            // if ($confirmed == true) {
            //     $browser
            //     ->pause('3000')
            //     ->assertSee('sedang berlangsung', true)
            //     ->click('#open-detail-confirmed')
            //     ->screenshot('admin/2-transaction/6.2-detail-transaksi-confirmed')
            //     ->pause('3000')
            //     ;
            // } else {
            //     $browser
            //     ->assertSee('status pembayaran', true)
            //     ->screenshot('admin/2-transaction/6.2.1-no-transaksi-confirmed')
            //     ->pause('3000')
            //     ;
            // }
            
            // if ($completed == true) {
            //     $browser
            //     ->pause('3000')
            //     ->assertSee('selesai', true)
            //     ->click('#open-detail-completed')
            //     ->screenshot('admin/2-transaction/6.3-detail-transaksi-completed')
            //     ->pause('3000')
            //     ;
            // } else {
            //     $browser
            //     ->assertSee('status pembayaran', true)
            //     ->screenshot('admin/2-transaction/6.3.1-no-transaksi-completed')
            //     ;
            // }
        });
    }

    public function test_admin_confirm_transaction(): void
    {
        $this->browse(function (Browser $browser) {
            $needConfirm = Transaction::where('order_status', 'need_confirm')->first();

            $browser->visit('/admin/dashboard')
            ->click('#transaksi-menu')
            ->assertSee('transaksi', true)
            ->assertSee('status pembayaran', true)
            ->assertSee('status booking', true)
            ;
            
            if ($needConfirm == true) {
                $browser
                ->pause('3000')
                ->click('#open-detail-need_confirm')
                ->click('#confirm-modal')
                ->pause('2000')
                ->screenshot('admin/2-transaction/7.1-konfirmasi-transaksi')
                ->click('#confirm-btn')
                ->assertSee('Konfirmasi Booking Berhasil', true)
                ->pause('2000')
                ->screenshot('admin/2-transaction/7.2-done-konfirmasi-transaksi')
                ->press('OK')
                ;
            } else {
                $browser
                ->assertSee('status pembayaran', true)
                ->screenshot('admin/2-transaction/7.3-all-confirmed')
                ;
            }
        });
    }

    public function test_admin_end_transaction(): void
    {
        $this->browse(function (Browser $browser) {
            $confirmed = Transaction::where('order_status', 'confirmed')->first();
            
            $browser->visit('/admin/dashboard')
            ->click('#transaksi-menu')
            ->assertSee('transaksi', true)
            ->assertSee('status pembayaran', true)
            ->assertSee('status booking', true)
            ;
            
            if ($confirmed == true) {
                $browser
                ->pause('3000')
                ->click('#open-detail-confirmed')
                ->click('#end-modal')
                ->pause('2000')
                ->screenshot('admin/2-transaction/8.1-selesaikan-transaksi')
                ->click('#end-btn')
                ->assertSee('Transaksi Selesai', true)
                ->pause('2000')
                ->screenshot('admin/2-transaction/8.2-done-selesaikan-transaksi')
                ->press('OK')
                ;
            } else {
                $browser
                ->assertSee('status pembayaran', true)
                ->screenshot('admin/2-transaction/8.3-booking-all-done')
                ;
            }
        });
    }

    public function test_admin_view_manage_court(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#kelola-lapangan-menu')
            ->assertSee('kelola lapangan', true)
            ->assertSee('tambah lapangan', true)
            ->screenshot('admin/4-manage-court/9.1-open-manage-court')
            ;
        });
    }

    public function test_admin_open_detail_court(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#kelola-lapangan-menu')
            ->assertSee('kelola lapangan', true)
            ->assertSee('tambah lapangan', true)
            ->click('#detail-lapangan-2')
            ->assertSee('tambah foto', true)
            ->assertSee('foto lapangan', true)
            ->screenshot('admin/4-manage-court/10.1-open-detail-court')
            ;
        });
    }

    public function test_admin_edit_court_image(): void
    {
        $this->browse(function (Browser $browser) {
            $court = Court::latest('id')->first();
            $data = CourtImages::latest('id')->first();

            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#kelola-lapangan-menu')
            ->assertSee('kelola lapangan', true)
            ->assertSee('tambah lapangan', true)
            ->click('#detail-lapangan-2')
            ->assertSee('tambah foto', true)
            ->assertSee('foto lapangan', true)
            ->click('#edit-5')
            ->assertSee('preview foto terbaru', true)
            ->attach('image', __DIR__.'/photos/cth-lap-1.jpg')
            ->pause('2000')
            ->screenshot('admin/4-manage-court/11.1-edit-court-image-form')
            ->press('#btn-edit-tambah')
            ->pause('3000')
            ->assertSee('Foto lapangan berhasil diubah', true)
            ->screenshot('admin/4-manage-court/11.2-done-edit-court-image-form')
            ;
        });
    }

    public function test_admin_add_court_image(): void
    {
        $this->browse(function (Browser $browser) {
            $court = Court::latest('id')->first();

            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#kelola-lapangan-menu')
            ->assertSee('kelola lapangan', true)
            ->assertSee('tambah lapangan', true)
            ->click('#detail-' . $court->slug)
            ->assertSee('tambah foto', true)
            ->assertSee('foto lapangan', true)
            ->click('#add-' . $court->slug)
            ->assertSee('preview foto', true)
            ->attach('image', __DIR__.'/photos/cth-lap-1.jpg')
            ->pause('2000')
            ->screenshot('admin/4-manage-court/12.1-add-court-image-form')
            ->press('#btn-edit-tambah')
            ->pause('3000')
            ->assertSee('Foto lapangan berhasil ditambahkan', true)
            ->screenshot('admin/4-manage-court/12.2-done-add-court-image-form')
            ;
        });
    }

    public function test_admin_delete_court_image(): void
    {
        $this->browse(function (Browser $browser) {
            $data = CourtImages::latest('id')->first();
            $court = Court::latest('id')->first();

            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#kelola-lapangan-menu')
            ->assertSee('kelola lapangan', true)
            ->assertSee('tambah lapangan', true)
            ->click('#detail-' . $court->slug)
            ->assertSee('tambah foto', true)
            ->assertSee('foto lapangan', true)
            ->press('#del-modal-' . $data->id)
            ->pause('2000')
            ->assertSee('Yakin ingin menghapus foto lapangan yang dipilih?', true)
            ->screenshot('admin/4-manage-court/13.1-delete-modal-court-image')
            ->press('#delete-btn')
            ->pause('1000')
            ->assertSee('Foto lapangan berhasil dihapus', true)
            ->screenshot('admin/4-manage-court/13.2-done-delete-court-image')
            ;
        });
    }

    public function test_admin_add_court(): void
    {
        $this->browse(function (Browser $browser) {
            $court = Court::latest('id')->first();
            $newCourt = $court->id + 1;
            $addCourt = 'Lapangan ' . $newCourt;

            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#kelola-lapangan-menu')
            ->assertSee('kelola lapangan', true)
            ->assertSee('tambah lapangan', true)
            ->click('#tambah-lapangan')
            ->assertSee('nama lapangan', true)
            ->assertSee('deskripsi', true)
            ->type('court_name', $addCourt)
            ->type('description', 'Deskripsi ' . $addCourt)
            ->pause('2000')
            ->screenshot('admin/4-manage-court/14.1-add-court-form')
            ->press('#btn-tambah-lapangan')
            ->pause('3000')
            ->assertSee('Berhasil menambahkan lapangan baru', true)
            ->screenshot('admin/4-manage-court/14.2-done-add-court-form')
            ;
        });
    }

    public function test_admin_edit_court(): void
    {
        $this->browse(function (Browser $browser) {
            $court = Court::latest('id')->first();
            $newCourt = $court->id + 1;
            $addCourt = 'Lapangan ' . $newCourt;

            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#kelola-lapangan-menu')
            ->assertSee('kelola lapangan', true)
            ->assertSee('tambah lapangan', true)
            ->click('#edit-' . $court->slug)
            ->assertSee('nama lapangan', true)
            ->assertSee('deskripsi', true)
            ->type('description', 'Edit Deskripsi ' . $court->court_name)
            ->pause('2000')
            ->screenshot('admin/4-manage-court/15.1-edit-court-form')
            ->press('#btn-edit-lapangan')
            ->pause('3000')
            ->assertSee('Informasi lapangan berhasil diubah', true)
            ->screenshot('admin/4-manage-court/15.2-done-edit-court-form')
            ;
        });
    }

    public function test_admin_delete_court(): void
    {
        $this->browse(function (Browser $browser) {
            $court = Court::latest('id')->first();

            $browser->visit('/admin/dashboard')
            ->pause('3000')
            ->click('#kelola-lapangan-menu')
            ->assertSee('kelola lapangan', true)
            ->assertSee('tambah lapangan', true)
            ->press('#del-modal-' . $court->id)
            ->pause('2000')
            ->assertSee('Yakin ingin menghapus lapangan yang dipilih?', true)
            ->screenshot('admin/4-manage-court/16.1-delete-modal-court')
            ->press('#delete-btn')
            ->pause('1000')
            ->assertSee('Lapangan berhasil dihapus', true)
            ->screenshot('admin/4-manage-court/16.2-done-delete-court')
            ;
        });
    }
}
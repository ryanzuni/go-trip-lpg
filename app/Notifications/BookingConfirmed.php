<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Booking;

class BookingConfirmed extends Notification
{
    use Queueable;

    protected $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $booking = $this->booking;

        return (new MailMessage)
            ->subject('Konfirmasi Booking Paket Wisata')
            ->greeting('Halo ' . $booking->nama . ',')
            ->line('Terima kasih telah melakukan booking paket wisata dengan detail berikut:')
            ->line('Paket Wisata: ' . $booking->paketWisata->nama_paket) 
            ->line('Tanggal Booking: ' . $booking->tanggal_booking)
            ->line('Jumlah Orang: ' . $booking->jumlah_orang)
            ->line('Harga per Orang: Rp ' . number_format($booking->harga_satuan, 0, ',', '.'))
            ->line('Total Harga: Rp ' . number_format($booking->total_harga, 0, ',', '.'))
            ->line('Catatan: ' . ($booking->catatan ?? '-'))
            ->line('Status Booking: ' . ucfirst($booking->status))
            ->line('Kami akan menghubungi Anda untuk konfirmasi lebih lanjut.')
            ->salutation('Terima kasih,')
            ->salutation(config('app.name'));

        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

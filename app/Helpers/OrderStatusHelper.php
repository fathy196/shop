<?php
namespace App\Helpers;

class OrderStatusHelper
{
    public static function getStatusColor($status)
    {
        return match($status) {
           'pending' => 'warning',
        'approved' => 'info',
        'shipped' => 'primary',
        // 'delivered' => 'success',
        'cancelled' => 'danger',
        default => 'secondary'
        };
    }
    /**
     * Get all available status options
     */
    public static function getAllStatuses(): array
    {
        return [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'shipped' => 'Shipped',
            // 'delivered' => 'Delivered',
            'cancelled' => 'Cancelled'
        ];
    }
    /**
 * Get icon for status
 */
public static function getStatusIcon(string $status): string
{
    return match($status) {
        'pending' => 'bi-hourglass',
        'approved' => 'bi-check-circle',
        'shipped' => 'bi-truck',
            // 'delivered' => 'bi-box-seam',
        'cancelled' => 'bi-x-circle',
        default => 'bi-question-circle'
    };
}

}
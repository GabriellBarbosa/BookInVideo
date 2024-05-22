<?php
add_filter('wc_order_statuses', 'renamingOrderStatus');
function renamingOrderStatus($orderStatuses) {
    foreach ($orderStatuses as $key => $status) {
        if ('wc-processing' === $key) 
            $orderStatuses['wc-processing'] = 'Liberado';
    }
    return $orderStatuses;
}
?>
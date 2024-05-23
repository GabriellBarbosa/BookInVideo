<?php
add_filter('wc_order_statuses', 'bookinvideo_renameProcessingOrderStatus');
function bookinvideo_renameProcessingOrderStatus($orderStatuses) {
    foreach ($orderStatuses as $key => $status) {
        if ('wc-processing' === $key) 
            $orderStatuses['wc-processing'] = 'Liberado';
    }
    return $orderStatuses;
}
?>
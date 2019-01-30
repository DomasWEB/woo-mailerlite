<?php


namespace MailerLiteApi\Api;

use MailerLiteApi\Common\ApiAbstract;

class WooCommerce extends ApiAbstract
{
    protected $endpoint = 'woocommerce';

    public function setConsumerData( $consumerKey, $consumerSecret, $store, $apiKey, $currency )
    {

        $endpoint = $this->endpoint . '/consumer_data';

        $params = array_merge($this->prepareParams(), ['consumer_key' => $consumerKey, 'consumer_secret' => $consumerSecret, 'store' => $store, 'api_key' => $apiKey, 'currency' => $currency] );

        $response = $this->restClient->post( $endpoint, $params );

        return $response['body'];
    }

    public function setWebhooks($shop)
    {
        $endpoint = $this->endpoint.'/webhooks';

        $params = array_merge($this->prepareParams(), ['shop' => $shop] );

        return $this->restClient->post( $endpoint, $params );
    }

    public function saveOrder($orderData, $shop)
    {
        $endpoint = 'woocommerce/alternative_save_order';

        $params = array_merge($this->prepareParams(), ['order_data' => $orderData, 'shop' => $shop] );

        return $this->restClient->post( $endpoint, $params );
    }

    public function disconnectShop($shop)
    {
        $shopName = parse_url($shop, PHP_URL_HOST);
        $endpoint = 'woocommerce/disconnect_shop/'.$shopName;

        $params = [] ;
        return $this->restClient->delete( $endpoint, $params );
    }
}
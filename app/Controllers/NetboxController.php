<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NetboxController extends BaseController
{
    /**
     * Menampilkan list devices dari Netbox
     * GET /netbox/devices
     */
    public function index()
    {
        // API Key akan di-set di .env atau config
        $netboxUrl = getenv('NETBOX_URL') ?: 'http://localhost:8000';
        $apiKey = getenv('NETBOX_API_KEY') ?: '';
        
        if (empty($apiKey)) {
            return redirect()->back()
                ->with('error', 'Netbox API Key belum dikonfigurasi. Silakan set NETBOX_API_KEY di .env');
        }
        
        $client = \Config\Services::curlrequest();
        
        try {
            $response = $client->get($netboxUrl . '/api/dcim/devices/', [
                'headers' => [
                    'Authorization' => 'Token ' . $apiKey,
                    'Accept' => 'application/json',
                ],
                'http_errors' => false,
            ]);
            
            $statusCode = $response->getStatusCode();
            
            if ($statusCode !== 200) {
                throw new \Exception('Netbox API error: ' . $statusCode);
            }
            
            $result = json_decode($response->getBody(), true);
            $devices = $result['results'] ?? [];
            
            $data = [
                'title' => 'Netbox Devices',
                'devices' => $devices,
                'netboxUrl' => $netboxUrl,
            ];
            
            return view('netbox/devices', $data);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengambil data dari Netbox: ' . $e->getMessage());
        }
    }
}
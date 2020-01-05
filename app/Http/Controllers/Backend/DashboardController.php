<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Message\MessageRepository;
use App\Repositories\Backend\Message\PriceRepository;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{

    protected $messageRepository;
    protected $priceRepository;

    /**
     * DashboardControllerConstructor function
     *
     * @param MessageRepository $messageRepository
     * @param PriceRepository $priceRepository
     */
    public function __construct(MessageRepository $messageRepository, PriceRepository $priceRepository)
    {
        $this->messageRepository = $messageRepository;
        $this->priceRepository = $priceRepository;
    }



    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $uniquemessage =  $this->messageRepository->getMessageUniqueAllMessage();
        $calculateditems = $this->calculatePrice($uniquemessage);
        $priceitems = $this->priceRepository->all();
        return view('backend.dashboard')->with(compact('calculateditems', 'priceitems'));
    }


    /**
     * CalculatePrice function called by constructor
     *
     * @return void
     */
    public function calculatePrice($uniquemessage)
    {

        $typea =  $this->calculate('A');
        $typeb =  $this->calculate('B');
        $typec =  $this->calculate('C');
        $typed =  $this->calculate('D');
        $typeunknown = $this->calculate('unknown');

        $totalprice
            = $typea['totalraised'] +
            $typeb['totalraised'] +
            $typec['totalraised'] +
            $typed['totalraised'] +
            $typeunknown['totalraised'];

        $totalparticipant =  $typea['totalcount'] +
            $typeb['totalcount'] +
            $typec['totalcount'] +
            $typed['totalcount'] +
            $typeunknown['totalcount'];

        $allcollected = array($typea, $typeb, $typec, $typed, $typeunknown);
        return compact('allcollected',  'totalprice', 'totalparticipant');
    }


    /**
     * Calculate function
     *
     * @return void
     * @param String $messagetype
     */
    public function calculate($messagetype)
    {
        $totalCount = $this->messageRepository->getMessageTypeCount($messagetype);


        $messagetypelist = $this->messageRepository->getMessageTypeAll($messagetype);
        $messageprice = $this->priceRepository->where('message_type_name', $messagetype)->get();
        $totalraised = 0;
        foreach ($messagetypelist as $value) {
            $totalraised = $totalraised + $value->message_value;
        }

        // if ($messagetype != 'unknown') {
        //     $totalraised = ((int) $messageprice[0]->price) * ((int) $totalCount);
        // } else {
        //     $totalraised = 0;
        // }
        return array('messagetype' => $messagetype, 'totalcount' => $totalCount, 'totalraised' => $totalraised);
    }
}
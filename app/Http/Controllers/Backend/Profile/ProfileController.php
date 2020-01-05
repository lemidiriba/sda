<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Message\MessageRepository;
use App\Repositories\Backend\Message\PriceRepository;
use DataTables;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{


    protected $messageRepository;
    protected $priceRepository;
    /**
     * ProfileControllerConstructor function
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
     * Create function
     *
     * @param Int $phone
     * @return void
     */
    public function profilepage($phone)
    {
        return DataTables::of($this->messageRepository->getMessageByPhone($phone))->make(true);
    }

    /**
     * Profile function
     */
    public function profile($phone)
    {
        $profilephonemessagetypeunique = $this->messageRepository->getMessageByPhoneUnique($phone);

        $phoneno = $phone;

        $calculatedprice = $this->calculatePrice($profilephonemessagetypeunique, $phone);
        return view('backend.profile')->with(compact('phoneno', 'calculatedprice'));
    }

    /**
     * CalculatePrice function called by constructor
     *
     * @return void
     */
    public function calculatePrice($profilephonemessagetypeunique, $phone)
    {
        $messagetype = array();
        $count = 0;
        $totalparticipant = 0;
        $totalprice = 0;

        foreach ($profilephonemessagetypeunique as $value) {

            $messagetype[$count] = $this->calculate($value->message_type, $phone);
            $count = $count + 1;
            //            return $messagetype[1]['totalcount'];
        }

        for ($i = 0; $i < count($messagetype); $i++) {
            $totalprice = $totalprice + $messagetype[$i]['totalraised'];
            //return $messagetype[$i]['totalcount'];
            //return $messagetype[$i];
            $totalparticipant = $totalparticipant + $messagetype[$i]['totalcount']; //[$i]['totalcount'];
        }

        return $allcollected = compact('messagetype', 'totalprice', 'totalparticipant');
    }


    /**
     * Calculate function
     *
     * @return void
     * @param String $messagetype
     */
    public function calculate($messagetype, $phone)
    {
        $totalCount = $this->messageRepository->getMessageTypeCountPhone($messagetype, $phone);

        $messageprice = $this->priceRepository->where('message_type_name', $messagetype)->get();

        if ($messagetype != 'unknown') {
            $totalraised = ((int) $messageprice[0]->price) * ((int) $totalCount);
        } else {
            $totalraised = 0;
        }
        return array('messagetype' => $messagetype, 'totalcount' => $totalCount, 'totalraised' => $totalraised);
    }
}

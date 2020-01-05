<?php

namespace App\Http\Controllers\Backend\Message;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Message\MessageRepository;
use App\Repositories\Backend\Message\PriceRepository;
use Illuminate\Contracts\Pagination\Paginator as PaginationPaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use DataTables;

//use Illuminate\Pagination\Factory;

/**
 * Class MessageController.
 */
class MessageController extends Controller
{

    protected $messageRepository;
    protected $priceRepository;

    /**
     * MessageControllerConstructor function
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

        $title = 'all';

        return view('backend.message')->with(compact('title'))->render();
    }

    /**
     * Allmessage function
     *
     * @return void
     */
    public function allmessage()
    {

        $singlephonemessagetotal = 0;
        $samplearray = array();
        $uniquephones = $this->messageRepository->getMessageUniqueAll();
        foreach ($uniquephones as $value) {
            $singlephonedatacount = $this->messageRepository->getMessageByPhoneCount($value->phone_no);
            $value['count'] = $singlephonedatacount;
            $phonemessage = $this->messageRepository->getMessageByPhone($value->phone_no);

            foreach ($phonemessage as $messagvalue) {

                $singlephonemessagetotal = $singlephonemessagetotal + (int) $messagvalue->message_value;
            }

            $value['calculated'] = $singlephonemessagetotal;
            $singlephonemessagetotal = 0;
        }


        return DataTables::of($uniquephones)->make(true);
    }



    /**
     * MessageTypeA function
     *
     * @return mixed
     */
    public function messageTypeA()
    {
        $title = 'a';


        return view('backend.message')->with(compact('title'))->render();
    }
    /**
     * GetMessage function
     *
     * @param String $messagetype
     * @return void
     */
    public function getmessagetype($messagetype)
    {
        //return $messagetype;
        $uniquemessagestypephone = $this->messageRepository->getMessageType($messagetype);

        foreach ($uniquemessagestypephone as $value) {
            $singlephonedatacount = $this->messageRepository->getMessagePhoneAndMessageCount($value->phone_no, $messagetype);
            $value['count'] = $singlephonedatacount;
            $value['calculated'] = $singlephonedatacount * $value->message_value;
        }
        return DataTables::of($uniquemessagestypephone)->make(true);
    }



    /**
     * MessageTypeB function
     *
     * @return mixed
     */
    public function messageTypeB()
    {
        $title = 'b';


        return view('backend.message')->with(compact('title'))->render();
    }

    /**
     * MessageTypeC function
     *
     * @return mixed
     */
    public function messageTypeC()
    {
        $title = 'c';

        return view('backend.message')->with(compact('title'))->render();
    }

    /**
     * MessageTypeD function
     *
     * @return mixed
     */
    public function messageTypeD()
    {
        $title = 'd';

        return view('backend.message')->with(compact('title'))->render();
    }

    /**
     * MessageTypeUnknown function
     *
     * @return mixed
     */
    public function messageTypeUnknown()
    {
        $title = 'unknown';

        return view('backend.message')->with(compact('title'))->render();
    }
}
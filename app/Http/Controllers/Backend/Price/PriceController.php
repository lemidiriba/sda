<?php

namespace App\Http\Controllers\Backend\Price;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Repositories\Backend\Message\MessageRepository;
use App\Repositories\Backend\Message\PriceRepository;
use DataTables;
use PhpParser\Builder\Class_;
use Illuminate\Http\Request;


/**
 * PriceControler class
 */
class PriceController extends Controller
{

    protected $messageRepository;
    protected $priceRepository;

    /**
     * PriceControllerConstructor function
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
     * Index function
     *
     * @return Illuminate/view
     */
    public function index()
    {
        return view('backend.pricelist');
    }

    /**
     * AddPrice function
     *
     * @param Request $request
     * @param Int $id
     * @return void
     */
    public function addPrice(Request $request)
    {
        $this->validate(
            $request,
            [
                'mesagetype' => ['required', 'string', 'unique:prices,message_type_name'],
                'messageprice' => ['required', 'numeric', 'min:1'],
            ]
        );

        $addprice = new Price();
        $messagevalue = strtoupper($request->input('mesagetype'));

        $addprice->message_type_name = $messagevalue;
        $addprice->price =  $request->input('messageprice');

        $addprice->save();

        $pricedata = $this->priceRepository->get();
        return DataTables::of($pricedata)->make(true);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //return $request;
        $this->validate(
            $request,
            [
                'messagepriceupdate' => ['required', 'numeric', 'min:1'],
            ]
        );
        $updateprice = Price::find($id);
        $updateprice->price = $request->input('messagepriceupdate');
        $updateprice->update();

        $pricedata = $this->priceRepository->get();
        return DataTables::of($pricedata)->make(true);
    }

    /**
     * Delete function
     *
     * @param Request $request
     * @param Int $id
     * @return void
     */
    public function delete(Request $request, $id)
    {
        $deleteprice = Price::find($id);
        $deleteprice->delete();

        $pricedata = $this->priceRepository->get();
        return DataTables::of($pricedata)->make(true);
    }



    /**
     * Pricelist function
     *
     * @return void
     */
    public function priceList()
    {

        $pricedata = $this->priceRepository->get();
        return DataTables::of($pricedata)->make(true);
    }
}
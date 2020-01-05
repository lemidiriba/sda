<?php

namespace App\Repositories\Backend\Message;


use App\Models\Message;
use App\Repositories\BaseRepository;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * MessageRepository class
 *
 */
class MessageRepository extends BaseRepository
{

    /**
     * MessageRepositoryConstruct function
     */
    public function __construct(Message $model)
    {
        $this->model = $model;
    }

    /**
     * GetMessageTypeAll function
     *
     * @return mixed
     */

    public function getMessageUniqueAllMessage()
    {
        return $this->all()->unique('message_type');

        //return DB::table('messages')->distinct('phone_no')->paginate(5);
    }

    /**
     * GetMessageTypeAll function
     *
     * @return mixed
     */

    public function getMessageUniqueAll()
    {
        return $this->all()->unique('phone_no');

        //return DB::table('messages')->distinct('phone_no')->paginate(5);
    }

    /**
     * GetMessageTypeAllSearch function
     *
     * @return mixed
     */

    public function getMessageUniqueAllSearch($phone)
    {
        return $this->where('phone_no', '%' . $phone . '%', 'like')->get()->unique('phone_no');

        //return DB::table('messages')->distinct('phone_no')->paginate(5);
    }


    /**
     * GetMessageTypeSearch function
     *
     * @return mixed
     */
    public function getMessageTypeSearch($phone, $messagetype)
    {
        return $this->where('message_type', $messagetype)->where('phone_no', $phone)->get()->unique('phone_no');
        //return DB::table('messages')->where('message_type', $messagetype)->distinct('phone_no')->paginate(10);
    }


    /**
     * GetMessageType function
     *
     * @return mixed
     */
    public function getMessageType($messagetype)
    {
        return $this->where('message_type', $messagetype)->get()->unique('phone_no');
        //return DB::table('messages')->where('message_type', $messagetype)->distinct('phone_no')->paginate(10);
    }

    /**
     * GetMessageType function
     *
     * @return mixed
     */
    public function getMessageTypeAll($messagetype)
    {
        return $this->where('message_type', $messagetype)->get();
        //return DB::table('messages')->where('message_type', $messagetype)->distinct('phone_no')->paginate(10);
    }

    /**
     * GetMessageTypePhone function
     *
     * @return mixed
     */
    public function getMessageTypeCountPhone($messagetype, $phone_no)
    {
        return DB::table('messages')->where('message_type', $messagetype)->where('phone_no', $phone_no)->count();
    }
    /**
     * GetMessageType function
     *
     * @return mixed
     */
    public function getMessageTypeCount($messagetype)
    {
        return DB::table('messages')->where('message_type', $messagetype)->distinct()->count();
    }


    /**
     * GetMessageByPhone function
     *
     * @return mixed
     */
    public function getMessageByPhoneUnique($phoneno)
    {
        return DB::table('messages')->where('phone_no', $phoneno)->get()->unique('message_type');
    }


    /**
     * GetMessageByPhone function
     *
     * @return mixed
     */
    public function getMessageByPhone($phoneno)
    {
        return DB::table('messages')->where('phone_no', $phoneno)->get();
    }

    /**
     * getMessageByPhoneAndMessage function
     *
     * @return mixed
     */
    public function getMessageByPhoneAndMessage($phoneno, $message)
    {
        return DB::table('messages')->where('phone_no', $phoneno)->where('message_type', $message)->get();
    }

    /**
     * GetMessageByPhone function
     *
     * @return mixed
     */
    public function getMessageByPhoneCount($phoneno)
    {
        return DB::table('messages')->where('phone_no', $phoneno)->count();
    }

    /**
     * GetMessageByPhoneand function
     *
     * @return mixed
     */
    public function getMessagePhoneAndMessageCount($phoneno, $messagetype)
    {
        return DB::table('messages')->where('phone_no', $phoneno)
            ->where('message_type', $messagetype)->count();
    }
}
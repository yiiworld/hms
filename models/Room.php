<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ps_room".
 *
 * @property integer $roomid
 * @property string $name
 * @property string $lockid
 * @property string $description
 * @property integer $floorid
 * @property integer $roomtypeid
 * @property integer $roomstatusid
 *
 * @property PsFloor $floor
 * @property PsRoomtype $roomtype
 * @property PsRoomstatus $roomstatus
 * @property PsRoomreservation[] $psRoomreservations
 * @property PsSeasonalratedetail[] $psSeasonalratedetails
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ps_room';
    }

    public $varfloor;
    public $varroomtype;
    public $varroomstatus;
    public $discounts;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'floorid', 'roomtypeid', 'roomstatusid'], 'required'],
            [['floorid', 'roomtypeid', 'roomstatusid'], 'integer'],
            [['name', 'lockid'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
            ['discounts', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'roomid' => 'ID',
            'name' => 'Name',
            'lockid' => 'Lock ID',
            'description' => 'Description',
            'floorid' => 'Floor',
            'roomtypeid' => 'Room Type',
            'roomstatusid' => 'Room Status',
            'varfloor' => 'Floor',
            'varroomtype' => 'Room Type',
            'varroomstatus' =>'Room Status'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFloor()
    {
        return $this->hasOne(Floor::className(), ['floorid' => 'floorid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomtype()
    {
        return $this->hasOne(RoomType::className(), ['roomtypeid' => 'roomtypeid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomstatus()
    {
        return $this->hasOne(RoomStatus::className(), ['roomstatusid' => 'roomstatusid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomreservations()
    {
        return $this->hasMany(RoomReservation::className(), ['roomid' => 'roomid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeasonalratedetails()
    {
        return $this->hasMany(SeasonalRateDetail::className(), ['roomid' => 'roomid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomDiscount()
    {
        return $this->hasMany(DiscountRoom::className(), ['roomid' => 'roomid']);
    }

    public function getroomstatusColor(){
        return '<span class="label" style="background-color: '.$this->roomstatus->color.';">'.$this->roomstatus->name.'</span>';
    }

    public function getcolorHtml(){
        return '<span class="label" style="background-color: '.$this->roomstatus->color.';">'.$this->roomstatus->name.'</span>';
    }

    public function getDiscountHtml(){
        $discounts = DiscountRoom::find()->where('roomid = :1',[':1'=>$this->roomid,])->all();
        $html = '<table>';
        foreach($discounts as $discount){
            $html .= '<tr><td><span>' . $discount->discount->name . '<span> <small class="discount-lbl label label-default">' . 
                date('d-M-Y', strtotime($discount->discount->from_date)) . ' - ' .
                (isset($discount->discount->to_date) ? date('d-M-Y', strtotime($discount->discount->to_date)) : 'Now') . 
                '</small>' . '</td></tr>';
        }
        $html .= '</table>';
        return $html;
    }
}

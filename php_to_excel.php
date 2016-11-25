<?php

/*
提交json数据
 {
  "text":{
    "4697":"i","4698":"love","4699":"you"
  },
  "radio":{
    "4700":{"8352":"888"}
  },
  "checkbox":{"4701":{"8354":"(1).44444","8355":"(2).666666"}}
}*/

/*mysql> select *from question_survey_ques where ask_id=569\G
        id: 652
    ask_id: 569
      type: 0
   subject: 2016
  ordernum: 0
      must: 0
created_at: 2016-11-24 16:13:57
updated_at: 2016-11-24 16:14:11

        id: 657
    ask_id: 569
      type: 2
   subject: BAT
  ordernum: 0
      must: 0
created_at: 2016-11-24 16:16:07
updated_at: 2016-11-24 16:16:53
6 rows in set (0.01 sec)*/
// 问题数组
$ques =  [
  0 => [
    "id" => 652,
    "subject" => "2016",
    "type" => 0
  ],
  1 => [
    "id" => 653,
    "subject" => "2017",
    "type" => 0
  ],
  2 => [
    "id" => 654,
    "subject" => "你是谁",
    "type" => 1
  ],
  3 => [
    "id" => 655,
    "subject" => "你最喜欢的歌手",
    "type" => 1
  ],
  4 => [
    "id" => 656,
    "subject" => "你喜欢的电影",
    "type" => 2
  ],
  5 => [
    "id" => 657,
    "subject" => "BAT",
    "type" => 2
  ],
];

/*mysql> select *from question_survey_ques where ask_id=569 and type=0\G
*************************** 1. row ***************************
        id: 652
    ask_id: 569
      type: 0
   subject: 2016
  ordernum: 0
      must: 0
created_at: 2016-11-24 16:13:57
updated_at: 2016-11-24 16:14:11
*************************** 2. row ***************************
        id: 653
    ask_id: 569
      type: 0
   subject: 2017
  ordernum: 0
      must: 0
created_at: 2016-11-24 16:14:11
updated_at: 2016-11-24 16:14:18
2 rows in set (0.04 sec)

文本 ques_id来自question_survey_ques里的type=0的id
mysql> select ques_id,answer from question_survey_answers where ask_id=569 and ques_id in(652,653);
+---------+--------+
| ques_id | answer |
+---------+--------+
|     652 | 16     |
|     652 | 1111   |
|     653 | 17     |
|     653 | 2222   |
+---------+--------+
4 rows in set (0.00 sec)*/
// 填空题 2个人回答了
$text = [
  0 => [
    "ques_id" => 652,
    "answer" => "16"
  ],
  1 => [
    "ques_id" => 652,
    "answer" => "1111"
  ],
  2 => [
    "ques_id" => 653,
    "answer" => "17"
  ],
  3 => [
    "ques_id" => 653,
    "answer" => "2222"
  ],
];



/*mysql> select count(id) num,item_subject,ques_id from question_survey_answer_items where ask_id=569 and item_type=1 group by item_id;
+-----+--------------+---------+
| num | item_subject | ques_id |
+-----+--------------+---------+
|   2 | (1).我就是我 |     654 |
|   1 | (1).周杰伦   |     655 |
|   1 | (2).王菲     |     655 |
+-----+--------------+---------+
3 rows in set (0.01 sec)*/
// 单选题
$radioItems=[
  0 => [
    "num" => 2,
    "item_subject" => "(1).我就是我",
    "ques_id" => 654
  ],
  1 => [
    "num" => 1,
    "item_subject" => "(1).周杰伦",
    "ques_id" => 655
  ],
  2 => [
    "num" => 1,
    "item_subject" => "(2).王菲",
    "ques_id" => 655
  ],
];


/*mysql> select count(id) num,item_subject,ques_id from question_survey_answer_items where ask_id=569 and item_type=2 group by item_id;
+-----+------------------+---------+
| num | item_subject     | ques_id |
+-----+------------------+---------+
|   1 | (1).肖申克的救赎 |     656 |
|   1 | (2).阿甘正传     |     656 |
|   1 | (3).阳光灿烂日子 |     656 |
|   2 | (1).百度         |     657 |
|   2 | (2).腾讯         |     657 |
|   1 | (3).阿里         |     657 |
+-----+------------------+---------+
6 rows in set (0.00 sec)*/
$checkboxItems=[
  0 => [
    "num" => 1,
    "item_subject" => "(1).肖申克的救赎",
    "ques_id" => 656
  ],
  1 => [
    "num" => 1,
    "item_subject" => "(2).阿甘正传",
    "ques_id" => 656
  ],
  2 => [
    "num" => 1,
    "item_subject" => "(3).阳光灿烂日子",
    "ques_id" => 656
  ],
  3 => [
    "num" => 2,
    "item_subject" => "(1).百度",
    "ques_id" => 657
  ],
  4 => [
    "num" => 2,
    "item_subject" => "(2).腾讯",
    "ques_id" => 657
  ],
  5 => [
    "num" => 1,
    "item_subject" => "(3).阿里",
    "ques_id" => 657
  ],
];
$result = [];
        foreach ($ques as $key => $value) {
            $key = $key + 1;
            if ($value['type'] == 1) {
                $result[$value['id']][] = ['Q'.$key.':'.$value['subject'].'(单选题)'];
                $result[$value['id']][] = ['选项', '选择人数'];
                foreach ($radioItems as $k => $v) {
                    if ($value['id'] == $v['ques_id']) {
                        // $result[$value['id']][$v['ques_id']][] = [$v['item_subject'], $v['num']];
                        $result[$value['id']][] = [$v['item_subject'], $v['num']];
                    }
                }
            } elseif ($value['type'] == 2) {
                $result[$value['id']][] = ['Q'.$key.':'.$value['subject'].'(多选题)'];
                $result[$value['id']][] = ['选项', '选择人数'];
                foreach ($checkboxItems as $k => $v) {
                    if ($value['id'] == $v['ques_id']) {
                        $result[$value['id']][] = [$v['item_subject'], $v['num']];
                    }
                    
                }
            } elseif ($value['type'] == 0) {
                $result[$value['id']][] = ['Q'.$key.':'.$value['subject'].'(问答题)'];
                $result[$value['id']][] = ['答案'];
                foreach ($text as $k => $v) {
                    if ($value['id'] == $v['ques_id']) {
                        $result[$value['id']][] = [$v['answer']];
                    }
                }
            }
        }
$result = array_values($result);
echo '<pre>';print_r($result);
/*Array
(
    [0] => Array
        (
            [0] => Array
                (
                    [0] => Q1:2016(问答题)
                )

            [1] => Array
                (
                    [0] => 答案
                )

            [2] => Array
                (
                    [0] => 16
                )

            [3] => Array
                (
                    [0] => 1111
                )

        )

    [1] => Array
        (
            [0] => Array
                (
                    [0] => Q2:2017(问答题)
                )

            [1] => Array
                (
                    [0] => 答案
                )

            [2] => Array
                (
                    [0] => 17
                )

            [3] => Array
                (
                    [0] => 2222
                )

        )

    [2] => Array
        (
            [0] => Array
                (
                    [0] => Q3:你是谁(单选题)
                )

            [1] => Array
                (
                    [0] => 选项
                    [1] => 选择人数
                )

            [2] => Array
                (
                    [0] => (1).我就是我
                    [1] => 2
                )

        )

    [3] => Array
        (
            [0] => Array
                (
                    [0] => Q4:你最喜欢的歌手(单选题)
                )

            [1] => Array
                (
                    [0] => 选项
                    [1] => 选择人数
                )

            [2] => Array
                (
                    [0] => (1).周杰伦
                    [1] => 1
                )

            [3] => Array
                (
                    [0] => (2).王菲
                    [1] => 1
                )

        )

    [4] => Array
        (
            [0] => Array
                (
                    [0] => Q5:你喜欢的电影(多选题)
                )

            [1] => Array
                (
                    [0] => 选项
                    [1] => 选择人数
                )

            [2] => Array
                (
                    [0] => (1).肖申克的救赎
                    [1] => 1
                )

            [3] => Array
                (
                    [0] => (2).阿甘正传
                    [1] => 1
                )

            [4] => Array
                (
                    [0] => (3).阳光灿烂日子
                    [1] => 1
                )

        )

    [5] => Array
        (
            [0] => Array
                (
                    [0] => Q6:BAT(多选题)
                )

            [1] => Array
                (
                    [0] => 选项
                    [1] => 选择人数
                )

            [2] => Array
                (
                    [0] => (1).百度
                    [1] => 2
                )

            [3] => Array
                (
                    [0] => (2).腾讯
                    [1] => 2
                )

            [4] => Array
                (
                    [0] => (3).阿里
                    [1] => 1
                )

        )

)*/
// 导出excel composer requeire maatwebsite/excel config/app.php 'Excel'     => 'Maatwebsite\Excel\Facades\Excel',
/*Excel::create(date('YmdHis'), function ($excel) use ($result) {
            foreach ($result as $key => $value) {
                $key = $key + 1;
                $excel->sheet('Q'.$key, function ($sheet) use ($value) {
                    $sheet->fromArray($value);
                });
            }
        })->export('xlsx');*/
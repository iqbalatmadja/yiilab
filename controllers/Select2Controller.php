<?php
class Select2Controller extends Controller {
  public function actionIndex()
  {
    $this->render('index',[]);
  }

  public function actionGetValues()
  {
    $options = [
      'results' =>[
        [
          'id' => 1,
          'text' => 'text1'
        ],
        [
          'id' => 2,
          'text' => 'text2'
        ],
        [
          'id' => 3,
          'text' => 'text3',
          'selected'=> true
        ],
        [
          'id' => 4,
          'text' => 'text4',
          'disabled' => true
        ],
        
      ],
      'pagination' => [
        'more' => true
      ]
    ];

    $options = [
      "results" => [
          [
              "text" => "Group 1",
              "children" => [
                  ["id" => 1, "text" => "Option 1.1"],
                  ["id" => 2, "text" => "Option 1.2"],
              ],
          ],
          [
              "text" => "Group 2",
              "children" => [
                  ["id" => 3, "text" => "Option 2.1"],
                  ["id" => 4, "text" => "Option 2.2"],
              ],
          ],
      ],
      "pagination" => ["more" => true],
  ];
  
    echo json_encode($options);

    /*
    echo '{
      "results": [
        { 
          "text": "Group 1", 
          "children" : [
            {
                "id": 1,
                "text": "Option 1.1"
            },
            {
                "id": 2,
                "text": "Option 1.2"
            }
          ]
        },
        { 
          "text": "Group 2", 
          "children" : [
            {
                "id": 3,
                "text": "Option 2.1"
            },
            {
                "id": 4,
                "text": "Option 2.2"
            }
          ]
        }
      ],
      "pagination": {
        "more": true
      }
    }';
    */

  }

}

/**
 * EOF
*/

<?php
/*подключение библиотек*/
require_once "Lib_db.php";


    $v = 1;

    Add_Head();

    ?>


    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#Modal">
        Личный кабинет
    </button>



    <div class="modal fade" id="Modal">
    <?php
    if($e != 1) {
    
    ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Произвольное окно</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate magnam, 
                          soluta cumque molestias nemo in, consectetur recusandae eveniet nostrum ratione temporibus, 
                          sint consequatur quae? Sunt iusto eos laboriosam fugiat voluptatibus.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        Add_Footer();
        
        }
        
        else
        {
            echo 'hello';
        };
        ?>
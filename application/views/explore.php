<!DOCTYPE html>

    <main>
        <div id="gallery1">
            <div id="filter">
                <h3>Kategori :</h3>
                <ul>
                    <?php foreach($select_category->result() as $result) 
                    {   ?>
                        <li>
                            <input type="checkbox" id="<?php echo $result->id_category; ?>" value="<?php echo str_replace(' ','',$result->category_name); ?>">
                            <label for="<?php echo $result->id_category; ?>"><?php echo $result->category_name; ?> </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div id="search-result">
                <div class="row">
                    <div class="container">
                        <div  id="infinite-scroll">
                            <?php
                                $this->load->view('exam', $select_exam);
                            ?>
                        </div>
                        
                    </div>
                </div>
                
                <div id="load-more">
                <button class="waves-effect waves-light btn blue darken-3" style="margin-bottom:10px;" id="moreload"> Muat Lebih </button>
                </div>
            </div>
        </div>
    </main> 

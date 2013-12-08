<script src='public/js/Index.js' type='text/javascript'></script>
<script src='public/js/IndexAction.js' type='text/javascript'></script>
<script type='text/javascript'>
    var index = new Index();
</script>
<div class='leftother'>
    <div class='l'>
        <div class="side_menu">
            <a href='#1' data-ref="slider1" class='cross-link'>Home</a> <br />
            <a href='#2' data-ref="slider1" class='cross-link'>Gallery</a> <br />
            <a href='#3' data-ref="slider1" class='cross-link'>About</a> <br />
            <a href='#4' data-ref="slider1" class='cross-link'>Rates</a> <br />
            <a href='<?php echo APP_ROOT; ?>/pages/admin.php' rel='facebox'>Login</a> <br />
        </div>
    </div>
    <div class='r'>
        <?php if(isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) { ?>
            <ul class="err">
            <?php foreach($_SESSION['ERRMSG_ARR'] as $message) { ?>
                <li><?php echo $message; ?></li>
            <?php } ?>
            </ul>
            <?php unset($_SESSION['ERRMSG_ARR']);
        } ?>
        <div class='right3'>
            <div class='slider-wrap'>
                <div id='slider1' class="coda-slider">
                    <div class='panel' title='Panel 1'>
                        <div class='wrapper'>
                            <div>
                                <p> <img class="main_img bradius5" src='public/img/space_hotel.jpg' alt='Space Hotesl' /> </p>
                                <p align='center'> <strong>Welcome to the Space Hotel</strong> </p>
                                <p align='justify'><i>Why go to a hotel when you can go to a hotel in SPACE!</i></p>
                                <p align='justify'> For over 2 weeks the Space Hotel has been the first and best name in interstellar accommodation. With approximately 1 location throughout the solar system, Space Hotel can offer you the most comfortable and enjoyable experience this side of the Orion Nebula. </p>
                            </div>
                            <div>
                                <div class="featured">
                                    <img src='public/img/sample_room.jpg' alt='Space Hotel room' class="bradius5" />
                                </div>
                                <div class="front_facilities">
                                       <strong>Facilities</strong>
                                        <ul>
                                            <li>Luxury beds - double or single in air conditioned rooms</li>
                                            <li>Digital computers - with 16 bit colour display</li>
                                            <li>Astronaut food - made from real astronauts</li>
                                            <li>Space cats!</li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='panel' title='Panel 2'>
                        <div class='reservation_heading'><h2>Gallery</h2></div>
                        <div class='wrapper'>
                            <ul class='hoverbox'>
                                <a href='public/img/photos/1.jpg' rel='facebox'>
                                    <img src='public/img/photos/1.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/2.jpg' rel='facebox'>
                                    <img src='public/img/photos/2.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/3.jpg' rel='facebox'>
                                    <img src='public/img/photos/3.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/4.jpg' rel='facebox'>
                                    <img src='public/img/photos/4.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/5.jpg' rel='facebox'>
                                    <img src='public/img/photos/5.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/6.jpg' rel='facebox'>
                                    <img src='public/img/photos/6.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/7.jpg' rel='facebox'>
                                    <img src='public/img/photos/7.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/8.jpg' rel='facebox'>
                                    <img src='public/img/photos/8.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/9.jpg' rel='facebox'>
                                    <img src='public/img/photos/9.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/10.jpg' rel='facebox'>
                                    <img src='public/img/photos/10.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/11.jpg' rel='facebox'>
                                    <img src='public/img/photos/11.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/12.jpg' rel='facebox'>
                                    <img src='public/img/photos/12.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/13.jpg' rel='facebox'>
                                    <img src='public/img/photos/13.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/14.jpg' rel='facebox'>
                                    <img src='public/img/photos/14.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/15.jpg' rel='facebox'>
                                    <img src='public/img/photos/15.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/16.jpg' rel='facebox'>
                                    <img src='public/img/photos/16.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/17.jpg' rel='facebox'>
                                    <img src='public/img/photos/17.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/18.jpg' rel='facebox'>
                                    <img src='public/img/photos/18.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/19.jpg' rel='facebox'>
                                    <img src='public/img/photos/19.jpg' alt='description' />
                                </a>
                                <a href='public/img/photos/20.jpg' rel='facebox'>
                                    <img src='public/img/photos/20.jpg' alt='description' />
                                </a>
                            </ul>
                        </div>
                    </div>
                    <div class='panel' title='Panel 3'>
                        <div class='reservation_heading'><h2>About</h2></div>
                        <div class='wrapper'>
                            <div class='view1'>
                                <div align='justify'>
                                    <img src='public/img/photos/13.jpg' alt='Great View' style='float:right; width: 250px; padding: 3px;' class="bradius5" /> 
                                    <span class="about_text">
                                           The Space Hotel is the first name in accommodation outside the earth's atmosphere. 
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='panel' title='Panel 4'>
                        <div class='reservation_heading'><h2>Rates</h2></div>
                        <div class='wrapper'>
                            <ul id='room_rates'>
                            <?php foreach($page->rooms as $room) { ?>
                                <li>
                                <h3><?php echo $room["type"]; ?></h3>
                                <span><img src="public/img/photos/<?php echo $room["id"];?>.jpg" class="img_room"/></span>
                                <p><?php echo $room["description"];?><br />
                                <br /> <strong>Rate</strong>: <?php echo money_format('%(#10n', $room["rate"]); ?></p>
                                <div class='spacer' style='clear: both;'></div>
                                </li>
                             <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='rightother'>
    <div class='reservation'>
        <div class='reservation_heading'><h2>Make a Reservation</h2></div>
        <div class='reservation_form'>
            <form method='post' action='pages/roomselect.php' name='index'>
                <label>Arrival: </label>
                <input type='text' class='w8em format-d-m-y highlight-days-67 range-low-today validate_date_required' name='bookingArrivalDate' id='sd' value='' maxlength='10' readonly placeholder='Click calendar' />
                <br />
                <label>Depart: </label>
                <input type='text' class='w8em format-d-m-y highlight-days-67 range-low-today validate_date_required' name='bookingDepartureDate' id='ed' value='' maxlength='10' readonly placeholder='Click calendar' />
                <br />
                <label>Adult(s) : </label>
                <select name='bookingNumberAdults' class='ed' >
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <br />
                <div class='spacer' style='clear: both;'></div>
                <label>Children : </label>
                <select name='bookingNumberChildren' class='ed'>
                    <option>0</option>
                    <option>1</option>
                    <option>2</option>
                </select>
                <br />
                <div class='spacer' style='clear: both;'></div>
                <input name='' type='submit' value='Check Availability' class='button' id='SUBMIT' />
            </form>
            <div class='spacer' style='clear: both;'></div>
            <div align='center'>
                <br />
                <a rel='facebox' href='pages/reservationmodify.php'>Modify</a> / <a href='pages/reservationcancel.php' rel='facebox'>Cancel</a> Reservation   </div>
        </div>
    </div>
</div>
<!-- vim:set foldmethod=marker -->

FreiChat.get_ie_ver = function () {
    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    return rv;
};
//------------------------------------------------------------------------------
FreiChat.init_chatrooms = function ()
{

    var auto_close = false;

    if (freidefines.PLUGINS.chatroom_autoclose == "true")
        auto_close = true;

    FreiChat.chatroom.dcSlick({
        location: freidefines.PLUGINS.chatroom_location,
        classWrapper: 'frei_chatroom',
        classContent: 'frei_chatroom-content',
        align: 'left',
        offset: freidefines.PLUGINS.chatroom_offset, //'50px',
        speed: 'slow',
        classTab: 'frei_tab',
        tabText: freidefines.TRANS.chatroom_label,
        autoClose: auto_close
    });
    //    $jn('#frei_userpanel').html('loading ...........................');

    var frei_tab = $jn(".frei_tab");
    var position_shift = "top";


    if (freidefines.PLUGINS.chatroom_location == "top" || freidefines.PLUGINS.chatroom_location == "bottom") {
        position_shift = "left";
    }

    var margin_direction = "margin-left";

    $jn("#frei_chatroom_notify").css(freidefines.PLUGINS.chatroom_location, "0")
            .css("margin-" + freidefines.PLUGINS.chatroom_location, "4px");

    if (freidefines.PLUGINS.chatroom_location == "left") {
        margin_direction = "margin-right";
    }
    else if (freidefines.PLUGINS.chatroom_location == "top") {
        margin_direction = "margin-bottom";
    }
    else if (freidefines.PLUGINS.chatroom_location == "bottom") {
        margin_direction = "margin-top";
    }


    if (freidefines.PLUGINS.chatroom_rotate != "0") {

        var ie_ver = FreiChat.get_ie_ver();

        if (ie_ver === -1 ||
                (ie_ver !== -1 && ie_ver > 8.0)) {
            //rotation specified
            var degrees = freidefines.PLUGINS.chatroom_rotate;

            //dcslick gives margin right/left by width but here
            //we need it by height
            var delta = 3; //minor adjustment 
            var margin_shift = "-" + (2 * frei_tab.outerHeight() + delta) + "px";
            //2 times because when element is rotated it shifts
            //towards the left/right --> imagine ;)

            frei_tab.css({
                '-webkit-transform': 'rotate(' + degrees + 'deg)',
                '-moz-transform': 'rotate(' + degrees + 'deg)',
                '-ms-transform': 'rotate(' + degrees + 'deg)',
                '-o-transform': 'rotate(' + degrees + 'deg)',
                'transform': 'rotate(' + degrees + 'deg)',
                'zoom': 1

            }).css(margin_direction, margin_shift);
            //apply the rotations
        }
    }


    frei_tab.css(position_shift, freidefines.PLUGINS.chatroom_label_offset);//default: 0.8%

    var selected_chatroom = Get_Cookie('selected_chatroom');

    if (selected_chatroom == null) {
        selected_chatroom = 1;
    }

    FreiChat.in_room = selected_chatroom;

    FreiChat.my_name = "<div class='frei_room_n_online'>" + freidefines.chatroom_nolinemesg + "</div>";
    $jn('#frei_userpanel').html(FreiChat.my_name);

    FreiChat.set_smileys();

    $jn('#frei_chatroom_lobby_btn').click(function () {
        FreiChat.load_lobby();
    });


    FreiChat.frei_tab = $jn('.frei_tab');
    FreiChat.frei_tab.click(FreiChat.frei_tab_click);

    $jn('#frei_chatroom_back_btn').click(function () {
        $jn('.frei_tab').trigger("click");
        if (FreiChat.chatroom_notify_div.is(":visible")) {
            FreiChat.chatroom_notify();
        }
    });

    FreiChat.options_div = $jn('#frei_chatroom_tools');

    $jn('.frei_chatroom_notify_close').click(function () {
        FreiChat.chatroom_notify();
    });

    FreiChat.frei_chatroom_cnt = $jn(".frei_chatroom-content");
    FreiChat.chatroom_notify_div = $jn("#frei_chatroom_notify");
    FreiChat.chatroom_notify_cnt = $jn(".frei_chatroom_notify_content");
    FreiChat.chatroom_notify_div.css({
        "width": 0,
        "padding": 0
    }); //hide on first load

    FreiChat.frei_chatroom_cnt.hide();
    FreiChat.chatroom_notify_timer = false;


    $jn('#frei_create_chatroom').click(function () {
        $jn('#frei_roomtitle').html(freidefines.TRANS.create_chatroom_title);
        $jn('#frei_chatroom_creator').show();
        $jn('#frei_roompanel').hide();
        $jn('#frei_chatroom_creator_input').focus();

        $jn('#frei_create_chatroom').hide();
    });


    $jn('#frei_chatroom_creator_cancel').click(function () {

        $jn('#frei_chatroom_creator').hide();
        $jn('#frei_roompanel').show();
        $jn('#frei_create_chatroom').show();
        $jn('#frei_roomtitle').html(freidefines.TRANS.chatroom_lobby);
    });

    $jn('#frei_chatroom_creator_create').click(function () {
        FreiChat.create_chatroom(false);
    });

    $jn('#frei_chatroom_creator').hide();

    $jn("#frei_chatroom_creator_check").change(function () {
        if ($jn(this).is(":checked")) {
            $jn("#frei_chatroom_creator_password").show();
        } else {
            $jn("#frei_chatroom_creator_password").hide();
        }
    });

    $jn("#frei_chatroom_creator_password").hide();

};
//------------------------------------------------------------------------------
FreiChat.create_chatroom = function (is_mobile) {

    var name, password = '';

    if ($jn("#frei_chatroom_creator_check").is(":checked")) {
        password = $jn("#frei_chatroom_creator_password").val();
    }

    name = $jn.trim($jn('#frei_chatroom_creator_input').val());

    $jn.post(freidefines.GEN.url + "server/freichat.php?freimode=create_chatroom", {
        name: name,
        password: password,
        xhash: freidefines.xhash,
        id: freidefines.GEN.getid

    }, function (id) {

        if (id != "0") {
            $jn('#frei_chatroom_creator').hide();
            if (is_mobile) {
                FreiChat.open_panel(name, id, 'chatroom')
            } else {
                FreiChat.loadchatroom(name, id);
            }
            $jn('#frei_chatroom_creator_input').val('');
            $jn("#frei_chatroom_creator_password").val('');
            $jn('#frei_chatroom_creator_error').hide();
        } else {
            $jn('#frei_chatroom_creator_error').show();
        }
    });


};
//------------------------------------------------------------------------------
FreiChat.delete_chatroom = function (room_id, e) {
    e.stopPropagation();

    $jn.post(freidefines.GEN.url + "server/freichat.php?freimode=delete_chatroom", {
        room_id: room_id,
        xhash: freidefines.xhash,
        id: freidefines.GEN.getid
    }, function () {

        var obj = "FreiChat";
        if (freidefines.mobile == "1") {
            obj = "mobile";
        }

        $jn('#frei_lobby_room_' + room_id).fadeIn().remove();

        var len = window[obj].room_array.length;

        for (var i = 0; i < len; i++) {

            if (window[obj].room_array[i].room_id == room_id) {
                window[obj].room_array.splice(i, 1);
                break;
            }
        }
    });

    return false;
};
//------------------------------------------------------------------------------
FreiChat.validate_chatroom_pass = function (cht, password, is_mobile) {

    $jn.post(freidefines.GEN.url + "server/freichat.php?freimode=validate_chatroom_password", {
        xhash: freidefines.xhash,
        id: freidefines.GEN.getid,
        password: password,
        room_id: cht[1]
    }, function (data) {

        if (data === "correct") {
            if (is_mobile) {
                FreiChat.open_panel(cht[0], cht[1], cht[2], cht[3]);
            } else
                FreiChat.loadchatroom(cht[0], cht[1], cht[2]);
        } else {
            alert("the entered password is wrong!");
        }
    });
};
//------------------------------------------------------------------------------
FreiChat.frei_tab_click = function () {

    var hide = false;
    if (FreiChat.frei_tab.is(":visible")) {
        FreiChat.frei_chatroom_cnt.show();
    } else {
        hide = true;
    }
    FreiChat.frei_tab.fadeToggle(function () {

        if (FreiChat.jscrollers.indexOf("frei_chatroommsgcnt") === -1)
            FreiChat.create_scrollbar("frei_chatroommsgcnt");
        if (hide) {
            setTimeout(function () {
                FreiChat.frei_chatroom_cnt.hide()
            }, 100);
        }
    });

};
//------------------------------------------------------------------------------
FreiChat.chatroom_notify = function (txt, msgs) {

    var width = 0, padding = 0, room_name = '';

    for(var i=0; i<FreiChat.room_array.length; i++) {
        
        if(FreiChat.room_array[i].room_id == FreiChat.in_room) {
            
            room_name = FreiChat.room_array[i].room_name;
        }
    }

    if (typeof txt !== "undefined") {

        if (txt === "") {
            txt = freidefines.TRANS.new_chatroom_message + "<br/>";
            txt += "&nbsp;<em>" + room_name + "</em>";
        }
        FreiChat.chatroom_notify_cnt.html(txt);
        width = "200px";
        padding = "8px 10px 9px";
    }

    FreiChat.chatroom_notify_div.animate({width: width, padding: padding}, function () {
        FreiChat.chatroom_notify_timer = false;
    });

    if (width !== 0 && !FreiChat.chatroom_notify_timer)
        FreiChat.chatroom_notify_timer = setTimeout(function () {
            FreiChat.chatroom_notify();
        }, 3000);

};
//------------------------------------------------------------------------------
FreiChat.set_smileys = function () {

    var smileys = $jn('#frei_smileys_chatroom');
    var smile = $jn('#frei_smiley_chatroom_select');
    var isin = false;

    smile.mouseenter(function () {
        isin = true;
    }).mouseleave(function () {
        isin = false;
    });

    $jn(document).click(function () {
        if (smileys.hasClass('inline') && isin == false)
        {
            smileys.css('display', 'none')
                    .removeClass('inline')
                    .addClass('none');
        }
    });
};
//------------------------------------------------------------------------------
FreiChat.chatroom_off = function () {
    $jn("#dc-slick-9").hide();
};
//------------------------------------------------------------------------------
FreiChat.send_chatroom_message = function (textarea_div) {
    FreiChat.on_enter_press(null, textarea_div, FreiChat.in_room, null, 'chatroom');
};
//------------------------------------------------------------------------------
FreiChat.load_lobby = function () {

    $jn('#frei_lobby').show();
    $jn('#frei_chatroompanel').hide();
    $jn('#frei_roomtitle').html(freidefines.TRANS.chatroom_lobby);
    $jn('#frei_chatroom_lobby_btn').hide();
    $jn('#frei_roompanel').show();

    Set_Cookie('selected_chatroom', "-1");
    FreiChat.create_scrollbar("frei_roompanel");

};
//------------------------------------------------------------------------------

FreiChat.loadchatroom = function (title, id, type, me)
{

    if ((type == 1 || type == 3) && typeof me !== "undefined") {

        //password protection
        var reply = FreiChat.show_prompt("Enter chatroom password");

        if (reply) {
            var cht = [title, id, type, me, false];
            FreiChat.validate_chatroom_pass(cht, reply, false);
        }
        return;
    }

    FreiChat.chatroom_changed = true; // So that a new div is created for the first message and so that the message is not appended
    //FreiChat.usercreator(id);
    //var old_room = FreiChat.in_room;
    FreiChat.in_room = id;
    FreiChat.title = title;
    FreiChat.last_chatroom_usr_id = null;
    //alert(id);
    FreiChat.setCookie('selected_chatroom', id);
    // if(FreiChat.first == false) {   

    //FreiChat.roomcreator(title, id);
    $jn('#frei_roomtitle').html(FreiChat.title);
    $jn('#frei_lobby').hide();
    $jn('#frei_chatroompanel').show();
    $jn('#frei_chatroom_lobby_btn').show();

    $jn("#frei_chatroommsgcnt .frei_content").html('<div class="frei_spinner"><div class="frei_dot1"></div>  <div class="frei_dot2"></div></div>');
    $jn('#frei_chatroomtextarea').hide();
    FreiChat.chatroomLoading = true;

    $jn.getJSON(freidefines.GEN.url + "server/freichat.php?freimode=loadchatroom", {
        xhash: freidefines.xhash,
        id: freidefines.GEN.getid,
        first: FreiChat.first,
        time: FreiChat.time,
        chatroom_mesg_time: FreiChat.chatroom_mesg_time,
        custom_mesg: FreiChat.custom_mesg,
        in_room: id

    }, function (data) {



        if (data.time != null)
        {
            FreiChat.time = data.time;
        }

        if (data.chatroom_mesg_time != null)
        {
            FreiChat.chatroom_mesg_time = data.chatroom_mesg_time;
        }


        //FreiChat.room_array = data.room_array;

        FreiChat.chatroom_users[data.in_room] = FreiChat.create_chatroom_users(data.chatroom_users_array);
        FreiChat.usercreator(data.in_room);

        $jn('#frei_chatroomtextarea').show();
        FreiChat.chatroomLoading = false;
        if ($jn('#dc-slick-9').hasClass('active') && FreiChat.first != false) {
            FreiChat.append_chatroom_message_div(data.chatroom_messages, 'clear');
        }

    }, 'json');         //   alert(FreiChat.bulkmesg.length);


    //kind of unimportant so last
    FreiChat.roomcreator();
    var plugins = FreiChat.show_plugins(FreiChat.in_room, FreiChat.in_room);
    FreiChat.options_div.html(plugins);
    FreiChat.plugins.formatter.load();

    if (typeof me !== "undefined")
        $jn('#chatroommessagearea').focus();

};
//------------------------------------------------------------------------------
FreiChat.append_chatroom_message_div = function (messages, type) {

    if (typeof type == 'undefined') {
        type = 'nclear';
    }

    if (FreiChat.chatroomLoading) {

        type = 'clear';
    }

    var message_length = messages.length;
    var i = 0;
    var message = '';
    var scroll_to_top = false;
    var div = $jn("#frei_chatroommsgcnt .frei_content");
    var first_message = FreiChat.last_chatroom_msg_type[FreiChat.in_room];

    if (FreiChat.first_message == false) {
        first_message = false;
    } else
    {
        first_message = true;
    }
    //var //FreiChat.last_chatroom_msg_type[FreiChat.in_room];
    var local_in_room = FreiChat.in_room;


    var message_type = FreiChat.last_chatroom_msg_type[FreiChat.in_room];

    if (type == 'clear') {
        div.html('');
    }

    for (i = 0; i < message_length; i++) {
        FreiChat.chatroom_written[FreiChat.in_room] = true;

        if (first_message == true) {
            message_type = true;
        }

        if (messages[i].from == FreiChat.last_chatroom_usr_id && FreiChat.chatroom_written[FreiChat.in_room] == true) {// && FreiChat.last_in_chatroom == FreiChat.in_room) {//alert('message');
            $jn('#' + FreiChat.last_chatroom_msg_id).append("<br/>" + messages[i].message);
            scroll_to_top = true;
        } else
        {

            var from_name = messages[i].from_name;

            if (from_name == freidefines.GEN.fromname) {
                from_name = freidefines.TRANS.chat_message_me;
            }

            message = '<div id = "' + messages[i].room_id + '_chatroom_message"  class="frei_chatroom_message"><span style="display:none" id="' + local_in_room + '_message_type">LEFT</span>\n\
                <div class="chatroom_messagefrom_left"><span>' + from_name + '</span><span class="freichat_time" style="visibility:visible;padding-right:15px">' + FreiChat.getlocal_time(messages[i].GMT_time) + '</span></div>\n\
                <div id="room_msg_' + FreiChat.unique + '" class="frei_chatroom_msgcontent">' + messages[i].message + '</div>\n\
                </div>';


            div.append(message);
            scroll_to_top = true;
            FreiChat.last_chatroom_msg_id = 'room_msg_' + FreiChat.unique;
            FreiChat.unique++;
            first_message = false;
            FreiChat.last_chatroom_usr_id = messages[i].from;
            message_type = !message_type;

        }

    }

    FreiChat.last_chatroom_msg_type[FreiChat.in_room] = message_type;
    //alert(FreiChat.last_chatroom_msg_type[FreiChat.in_room]);
    if (scroll_to_top) {
        //$jn("#frei_chatroommsgcnt").scrollTop($jn("#frei_chatroommsgcnt")[0].scrollHeight);
        FreiChat.scroll_down("frei_chatroommsgcnt", false);

    }
    FreiChat.first_message = false;
};
//------------------------------------------------------------------------------
FreiChat.usercreator = function (id)
{

    //  if (FreiChat.chatroom_users.length > 0) {
    //alert(FreiChat.chatroom_users[id]);

    if (FreiChat.chatroom_users[id]) {
        $jn('#frei_userpanel').html(FreiChat.chatroom_users[id]);
    }
    // }
};
//------------------------------------------------------------------------------
FreiChat.create_chatroom_users = function (chatroom_users) {


    var len = chatroom_users.length, i = 0, userdiv = '';

    userdiv = '<div id="frei_userlist" class="frei_userlist frei_userlistme" >\n\
     <span class="freichat_userscontentname">' + freidefines.GEN.fromname + '</span>\n\
     </div>';

    for (i = 0; i < len; i++) {

        userdiv += '<div onmousedown=\'FreiChat.create_chat_window_mesg("' + chatroom_users[i]['username'] + '","' + chatroom_users[i]['userid'] + '")\' id="frei_userlist" class="frei_userlist" ">\n\
                            <span class="freichat_chatroom_avatar"><img src="' + chatroom_users[i]['avatar'] + '"  alt="avatar" align="left" class="freichat_userscontentavatarimage"/></span>\n\
                            <span class="freichat_userscontentname">' + chatroom_users[i]['username'] + '</span>\n\
                            <span >&nbsp;<img class ="freichat_userscontentstatus" src="' + chatroom_users[i]['img_url'] + '" height="12" width="12" alt="status" /></span>\n\
                    </div>';
    }

    return userdiv;

};
//------------------------------------------------------------------------------

FreiChat.roomcreator = function (/*title, id*/)
{
    //alert(id);
    //$jn('#frei_roomtitle').html(FreiChat.title);


    var sel_class = 'frei_lobby_room';
    var i = 0;
    var rooms = "";

    var del, lock, room_name;
    for (i = 0; i < FreiChat.room_array.length; i++)
    {
        del = '';
        lock = '';

        room_name = FreiChat.room_array[i].room_name.replace(/&#039;/g, "\\'");

        if(typeof FreiChat.room_online_count === "undefined" || typeof FreiChat.room_online_count[i] === "undefined")
            FreiChat.room_online_count[i] = 0;

        if (FreiChat.in_room == FreiChat.room_array[i].room_id && FreiChat.in_room != -1)
        {
            sel_class = 'frei_selected_room';
        }
        else {
            sel_class = 'frei_lobby_room';
        }
        rooms += '<div id="frei_lobby_room_' + FreiChat.room_array[i].room_id + '" class="' + sel_class + '"  onclick="FreiChat.loadchatroom(\'' + room_name + '\',' + FreiChat.room_array[i].room_id + ', ' + FreiChat.room_array[i].room_type + ', this)" >\n\
                    <span class="frei_lobby_room_1">' + FreiChat.room_array[i].room_name + '</span>';

        if (FreiChat.room_online_count[i].online_count == 0 && FreiChat.in_room == FreiChat.room_array[i].room_id) {
            rooms += '<span class="frei_lobby_room_2"><span id="room_new_messages_' + FreiChat.room_array[i].room_id + '">1</span> online</span>';
        }
        else

        {
            rooms += '<span class="frei_lobby_room_2"><span id="room_new_messages_' + FreiChat.room_array[i].room_id + '">' + FreiChat.room_online_count[i].online_count + '</span> online</span>';
        }

        if (FreiChat.room_array[i].room_author == freidefines.GEN.fromid) {
            del = '<a onclick="FreiChat.delete_chatroom(\'' + FreiChat.room_array[i].room_id + '\',event)">Delete</a>';
        }

        if (FreiChat.room_array[i].room_type == 1 || FreiChat.room_array[i].room_type == 3) {
            lock = "<img src='" + FreiChat.make_url(freidefines.lockedimg) + "' />";
        }
        rooms += '<span class="frei_lobby_room_3">' + del + '</span>\n\
                    <span class="frei_lobby_room_4">' + lock + '</span>\n\
                    <div style="clear:both"></div></div>';

    }
    $jn('#frei_roompanel .frei_content').html(rooms);

};
//------------------------------------------------------------------------------
FreiChat.update_room_online_cnt = function (old_cnt, new_cnt, room_array) {

    var len = new_cnt.length;
    var o_len = old_cnt.length;
    var container, cnt;

    var check = (len === o_len);

    for (var i = 0; i < len; i++) {

        container = $jn("#room_new_messages_" + room_array[i].room_id);
        cnt = new_cnt[i].online_count;

        if ((check && cnt !== old_cnt[i].online_count) || (!check)) {
            container.html(cnt);
        }
    }

};

/**
 * DEPRECATED : Was used by mobile which will be replaced by API
 * @param  {[type]} obj [description]
 * @return {[type]}     [description]
 */
FreiChat.modify_room_array = function (obj) {

    $jn.getJSON(freidefines.GEN.url + "server/freichat.php?freimode=get_rooms", {
        xhash: freidefines.xhash,
        id: freidefines.GEN.getid,
    }, function (data) {

        window[obj].room_array = data.rooms;
        window[obj].room_online_count = data.online_cnt;

        if (freidefines.mobile == "1") {
            fill_room_data();
        } else {
            FreiChat.roomcreator();
        }
    }, 'json');

};
/*------------------------------------------------------------------------------*/

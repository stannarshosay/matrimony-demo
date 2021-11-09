/**
 *
 * A simple interface to freichat 
 * Requires jsdef.js to be included before this
 *
 * Does not provide messages on initial load since mobile may not need it
 * so no usecase found yet.
 *
 * TODO:
 *
 *  2. post
 *  3. update_status
 *  6. loadchatroom
 */

"use strict"

var FreiChat = FreiChat || {};


/**
 * Works only in same tab. Similar to hook register/call
 * @type {Object}
 */
FreiChat.stream = {

	/**
	 * An object of subscribers which has a list of subsriber for every channel
	 * @type {Object}
	 */
	subscribers: {},

	/**
	 * When a new message is recieved
	 *
	 * {
	 * 	 GMT_time: "1505545482722", //You can use FreiChat.API.getLocalTime(gmtTime) to get the local time from this
	 *   from: "1505714018", //The sender's user id
	 *   from_name: "Guest-b5a1", // The sender's username
	 *   id: "28", //Unique id of this message
	 *   message: "hi", //Message content
	 *   message_type: "0", //0 -> Private message, 1 -> Chatroom message, 2 -> Video messages, 3 -> Group chat messages, 4 -> Internal freichat messages like user is typing
	 *   recd: "0", // 0 -> User has not yet recieved the message, 1 -> User has recieved the message
	 *   room_id: "-1", //Chatroom unique id if message belongs to a chatroom else -1
	 *   sent: "2017-09-16 07:04:43", //Serve date timestamp
	 *   time: "15055454830.0583", //Unix timestamp to order messages
	 *   to: "1505667098", // The reciever user id
	 *   to_name: "Guest-1uu" // The reciever user name
	 * }
	 * @type {String}
	 */
	CHANNEL_NEW_MESSAGE: "ON_MESSAGE",

	/**
	 * When user list is fetched. May be same or different.
	 * Always the entire list is fetched
	 *
	 * {
	 * 	 avatar: "https://www.gravatar.com/avatar/6ab2b04ef819e3f71460c5ec3701e45a?s=24&d=wavatar", //user's profile pic
	 *	 img_url: "https://localhost/humhub/freichat/client/themes/basic/images/onlineimg.png", //user's status images online/busy/invisible/offline
	 *	 profile_link: "", //link to user profile if integrated with any user profile system
	 *	 show_name: "Guest-1uu", //user display name as set in freichat
	 * 	 status_mesg: "I am available",//status message of user as set in freichat
	 *	 userid: "1505667098",//user id
	 *	 username: "Guest-1uu"//user name
	 * }
	 * @type {String}
	 */
	CHANNEL_USER_LIST: "ON_USERLIST",

	/**
	 * When chatroom list is fetched. Usually called when an user created chatroom is deleted
	 *
	 * {
	 * 	 online_count: "0", //No. of online users in this chatroom
	 *	 room_author: "admin", //The user who created the chatroom
	 *	 room_id: "1", //The unique id of this room FreiChat.in_room
	 *	 room_name: "Fun Talk", //Name of the room
	 *	 room_type: "0" //0 -> Default room, 1 -> Default password protected room 2 -> User created room, 3 -> Password protected user created room
	 *  }	 
	 * @type {String}
	 */
	CHANNEL_CHATROOM_LIST: "ON_CHATROOM_LIST",

	/**
	 * When a new chatroom is created by an user
	 *  
	 * Data has following structure
	 *
	 * {
	 *   room_author : "1505825951", //user id of the user that created the room
	 *   room_created : "1505502790", //time in ms when he created the room
	 *	 room_id : "9", //Unique id of the room -> FreiChat.room_id
	 *	 room_name : "dwedwe", //Name of the room
	 *	 room_type : "2" //0 -> Default room, 1 -> Default password protected room 2 -> User created room, 3 -> Password protected user created room
	 * }	 
	 * @type {String}
	 */
	CHANNEL_NEW_CHATROOM: "ON_NEW_CHATROOM",

	/**
	 * When room id and online counts are fetched from server
	 *
	 * {
	 * 	 id: "", //unique room id FreiChat.in_room,
	 * 	 online_count: "0" //No. of online users in this chatroom
	 * }
	 * @type {String}
	 */
	CHANNEL_CHATROOM_ONLINE_COUNT: "ON_CHATROOM_ONLINE_COUNT",


	/**
	 * The users online in current chatroom -> FreiChat.in_room
	 *
	 * {
	 *	 avatar: "http://www.gravatar.com/avatar/5cef1ab8c3c4ac2044dd0ebef6f899a4?s=24&d=wavatar", //user's profile pic
	 *	 img_url: "https://localhost/humhub/freichat/client/themes/basic/images/onlineimg.png", //user's status image online/offline/busy/invisible
	 *	 userid: "1505746989", //user id
	 *	 username: "Guest-1uy" //user name
	 * }
	 * @type {String}
	 */
	CHANNEL_CHATROOM_USER_LIST: "ON_CHATROOM_USER_LIST",

	/**
	 * Valid channels available in freichat
	 * @type {Array}
	 */
	channels: [],

	/**
	 * Publishes some data in the given channel
	 * Any Subscribers to this channel will recieve the data
	 * @param  {[type]} channel [description]
	 * @param  {[type]} data    [description]
	 * @return {[type]}         [description]
	 */
	pub: function(channel, data) {

		//no subscribers yet
		if(typeof this.subscribers[channel] === "undefined") return;

		var noOfSubscribers = this.subscribers[channel].length;
		var channelSubscribers = this.subscribers[channel];

		var publishDataToSubscribers = function() {

			while(noOfSubscribers--) {

				channelSubscribers[noOfSubscribers](data);
			}
		}

		//make it asynchronous so that no subscriber methods delay normal execution
		setTimeout(publishDataToSubscribers, 0);
	},

	/**
	 * Subscribers to any channel 
	 * @param  {[type]}   channel [description]
	 * @param  {Function} fn      [description]
	 * @return {[type]}           [description]
	 */
	sub: function(channel, fn) {

		if(typeof this.subscribers[channel] === "undefined")
			this.subscribers[channel] = [];

		this.subscribers[channel].push(fn);
	}

}


FreiChat.API = {
    //will get fired for every new user added to the list
    /**
     *
     * @param {Object} data
     * @param {Boolean} first
     * data contains the new user's following properties
     *
     *  data {
     *
     *     avatar : //Absolute url to his avatar pic
     *     img_url: //Absolute url to his current status
     *     profile_link: //Absolute url to his profile (empty if not available)
     *     show_name: //his name that will be visible
     *     status_mesg: //his current custom status message
     *     userid: //his userid
     *     username: //his username
     *
     *  }
     *
     *  first:
     *   true when method gets called for the first time
     *   false otherwise
     *
     *  TODO: Add a property to check whether he is a guest or an user
     *  NOTE: This function immediately gets called on page load when users
     *        are added for the first time to avoid that you can use the parameter
     *        first
     
     *
     */
    onNewUser: function (data, first) {

        /**
         * Example
         *
         if(!first)
         console.log(data.username + " was added to the list");
         */
    },
    /*----------------------------------------------------------------------------------------*/

    /**
     * Called when chatwindow html is added to the DOM
     * This gets called before any js events are binded
     * 
     * @param <object> {user, id}
     */
    onChatWindow: function (data) {

        if (FreiChat.is_allowed('GROUPCHAT') && freidefines.PLUGINS.showmobilechat == 'enabled')
            FreiChat.groupchat.initTag(data);
    },
    /*----------------------------------------------------------------------------------------*/
    //Gets called everytime there is a new message
    //You can use this function to make a beep sound or override to create
    //your own sound
    beep: function () {

        try {
            if (typeof FreiChat.beep !== "undefined" && FreiChat.sound_enabled === "on")
                FreiChat.beep.play();
        } catch (e) {
            FreiChat.buglog("info", "SoundManager Error: " + e);
        }
    },

    /**
     * The FreiChat API does not intiate unless you ask it to.
     * If main freichat is loaded, this method would already be called.
     * @return {[type]} [description]
     */
    run: function() {

		FreiChat.__methods.poll();
		window.setInterval(FreiChat.__methods.poll, freidefines.SET.chatspeed);
    },


    /**
     * Gets the local time based on user's timezone based on the GMT time passed
     * If 0 is passed, current time is returned
     * @return {[type]} [description]
     */
    getLocalTime: function(gmtTime) {

	    var d = FreiChat.Date;
		var offset

	    if (gmtTime == 0) {

	        gmtTime = FreiChat.getGMT_time();
		    offset = d.getTimezoneOffset()// * 60000;
	    }else {

		    offset = d.getTimezoneOffset() //* 60000;
		}

	    var timestamp = gmtTime - offset;
	    var dTime = new Date(timestamp);
	    var hours = dTime.getHours();
	    var minute = dTime.getMinutes();

	    if (minute < 10) {
	        minute = "0" + minute;
	    }
	    /*
	     var period = "AM";
	     if (hours > 12) {
	     period = "PM"
	     }
	     else {
	     period = "AM";
	     }*/
	    //hours = ((hours > 12) ? hours - 12 : hours)
	    return hours + ":" + minute + " ";// + period
    },

    /**
     * Gets current GMT time
     * @return {[type]} [description]
     */
    getGmtTime: function() {

	    var d = new Date();
	    var localtime = d.getTime();
	    var offset = d.getTimezoneOffset()// * 60000;
	    return localtime + offset;
    },


    /**
     * Gets all messages from given userid to current user
     * Acceps fn that will be executed when response is recieved from server
     * 
     * @param  {[type]} userid [description]
     * @return {[type]}        [description]
     */
    getAllMessagesFromUser:function(userid, fn) {	// syntax error resolved for IE

	    if (!FreiChat.RequestCompleted_isset_mesg) {

	    	setTimeout(function() {

	    		getAllMessagesFromUser(userid, fn);
	    	}, 100);
	    }
	    
        FreiChat.RequestCompleted_isset_mesg = false;
        $jn.getJSON(freidefines.GEN.url + "server/freichat.php?freimode=isset_mesg", {
            xhash: freidefines.xhash,
            id: freidefines.GEN.getid,
            Cid: userid
        }, function (data) {

        	fn(data);
        }, 'json')
        .complete(function () {
            FreiChat.RequestCompleted_isset_mesg = true;
        });

    }
};


/**
 * Not required from outside
 * @type {Object}
 */
FreiChat.__methods = {


	/**
	 * Requires jsdef.js
	 * @return {[type]} [description]
	 */
	poll: function() {

        if (!FreiChat.RequestCompleted_get_members) return;
        
        FreiChat.RequestCompleted_get_members = false;            

        $jn.getJSON(freidefines.GEN.url + "server/freichat.php?freimode=getmembers", {
            xhash: freidefines.xhash,
            id: freidefines.GEN.getid,
            first: FreiChat.first,
            time: FreiChat.time,
            chatroom_mesg_time: FreiChat.chatroom_mesg_time,
            'clrchtids[]': [FreiChat.clrchtids], //main freichat specific 
            custom_mesg: FreiChat.custom_mesg, //main freichat specific
            long_poll: FreiChat.long_poll, //main freichat specific
            in_room: FreiChat.in_room, //the current chatroom id
            custom_gst_name: FreiChat.custom_gst_name //main freichat specific

        }, function (data) {

        	FreiChat.stream.pub("CHANNEL_NEW_DATA", {data: data, first: FreiChat.first} ); //only used internally
        	FreiChat.stream.pub(FreiChat.stream.CHANNEL_USER_LIST, data.userdata);

        	if(data.messages.length > 0)
	        	FreiChat.stream.pub(FreiChat.stream.CHANNEL_NEW_MESSAGE, data.messages);

        	if(data.chatroom_messages.length > 0)
	        	FreiChat.stream.pub(FreiChat.stream.CHANNEL_NEW_MESSAGE, data.chatroom_messages);

	        if(data.chatroom_users_array.length > 0) 
	        	FreiChat.stream.pub(FreiChat.stream.CHANNEL_CHATROOM_USER_LIST, data.chatroom_users_array);

        	FreiChat.first = true; //this variable means opposite :)

            if (data.time != null)
            {
                FreiChat.time = data.time;
            }


            if(freidefines.PLUGINS.showchatroom == 'enabled') {

	            if (data.chatroom_mesg_time != null)
	            {
	                FreiChat.chatroom_mesg_time = data.chatroom_mesg_time;
	            }

	            FreiChat.stream.pub(FreiChat.stream.CHANNEL_NEW_CHATROOM, data.room_array);
	            FreiChat.stream.pub(FreiChat.stream.CHANNEL_CHATROOM_ONLINE_COUNT, data.room_online_count);

				if (data.room_online_count != null &&
					FreiChat.room_array.length != data.room_online_count.length) {
	                FreiChat.__methods.getAllRooms();
	            }

            }

        }, 'json')
        .complete(function () {
            FreiChat.RequestCompleted_get_members = true;
        });

	},

	/**
	 * Usually called when chatroom is deleted. Gets details of all chatrooms
	 * @return {[type]} [description]
	 */
	getAllRooms: function() {

	    $jn.getJSON(freidefines.GEN.url + "server/freichat.php?freimode=get_rooms", {
	        xhash: freidefines.xhash,
	        id: freidefines.GEN.getid,
	    }, function (data) {

	    	FreiChat.stream.pub(FreiChat.stream.CHANNEL_CHATROOM_LIST, data.rooms);
	    }, 'json');

	}

};

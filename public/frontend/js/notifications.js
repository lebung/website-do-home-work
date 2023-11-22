var notificationsWrapper   = $('.dropdown-notifications');
var notificationsToggle    = notificationsWrapper.find('a[data-bs-toggle]');
// var notificationsCountElem = notificationsToggle.find('i[data-count]');
var notificationsCountElem = $('.amount-notifi')
var notificationsCount     = parseInt(notificationsCountElem.html());
var notifications          = notificationsWrapper.find('ul.menu-notify');

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('c99225feca5b539fb20f', {
  cluster: 'ap1'
});

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('AddStudentClassNotify');

// Bind a function to a Event (the full Laravel class)
channel.bind('send-student-class', function(data) {
    var existingNotifications = notifications.html();
    var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
    var newNotificationHtml = `
        <li> 
            <a class="dropdown-item" href="https://support.webestica.com/" target="_blank">
                <i class="text-warning fa-fw bi bi-life-preserver me-2"></i>` +data.title+  `  <strong>`+data.class+ `</strong>
            </a> 
        </li>
    `;
    notifications.html(newNotificationHtml + existingNotifications);

    notificationsCount += 1;
    notificationsCountElem.html(notificationsCount);
    // notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
    console.log(notificationsCount);
});
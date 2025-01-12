import _ from "lodash";
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

$(function () {
    // 編集ボタン(class="js-modal-open")が押されたら処理返し
    $(".js-modal-open").on("click", function () {
        // モーダルの中身(class="js-modal")の表示
        $(".js-modal").fadeIn();
        // 押されたボタンから投稿内容を取得し変数へ格納
        var post = $(this).attr("post");
        // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
        var post_id = $(this).attr("post_id");

        // 取得した投稿内容をモーダルの中身へ渡す
        $(".modal_post").text(post);
        // 取得した投稿のidをモーダルの中身へ渡す
        $(".modal_id").val(post_id);
        return false;
    });

    // 背景部分や閉じるボタン(js-modal-close)が押されたら処理開始
    $(".js-modal-close").on("click", function () {
        // モーダルの中身(class="js-modal")を非表示
        $(".js-modal").fadeOut();
        return false;
    });
});

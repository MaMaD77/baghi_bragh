"use strict";

var swReady = navigator.serviceWorker.ready;

document.addEventListener("DOMContentLoaded", function () {
    initSW();
});

function initSW() {
    if (!"serviceWorker" in navigator) {
        //service worker isn't supported
        return;
    }

    //don't use it here if you use service worker
    //for other stuff.
    if (!"PushManager" in window) {
        //push isn't supported
        return;
    }

    //register the service worker
    navigator.serviceWorker
        .register("../sw.js")
        .then(() => {
            // console.log("serviceWorker installed!");
            initPush();
        })
        .catch((err) => {
            // console.log(err);
        });
}

function initPush() {
    if (!swReady) {
        return;
    }

    new Promise(function (resolve, reject) {
        const permissionResult = Notification.requestPermission(function (
            result
        ) {
            resolve(result);
        });

        if (permissionResult) {
            permissionResult.then(resolve, reject);
        }
    }).then((permissionResult) => {
        if (permissionResult !== "granted") {
            unsubscribeUser();
            throw new Error("We weren't granted permission.");
        } else {
            subscribeUser();
        }
    });
}

/**
 * Subscribe the user to push
 */
function subscribeUser() {
    swReady
        .then((registration) => {
            const subscribeOptions = {
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array(
                    document
                        .querySelector("meta[name=vapid-public-key]")
                        .getAttribute("content")
                ),
            };

            return registration.pushManager.subscribe(subscribeOptions);
        })
        .then((pushSubscription) => {
            // console.log(
            //     "Received PushSubscription: ",
            //     JSON.stringify(pushSubscription)
            // );
            storePushSubscription(pushSubscription);
        });
}

/**
 * Subscribe the user to push
 */
function unsubscribeUser() {
    swReady
        .then((registration) => {
            const subscribeOptions = {
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array(
                    document
                        .querySelector("meta[name=vapid-public-key]")
                        .getAttribute("content")
                ),
            };

            return registration.pushManager.unsubscribe(subscribeOptions);
        })
        .then((pushSubscription) => {
            // console.log(
            //     "Deleted PushSubscription: ",
            //     JSON.stringify(pushSubscription)
            // );
            deletePushSubscription(pushSubscription);
        });
}

/**
 * send PushSubscription to server with AJAX.
 * @param {object} pushSubscription
 */
function storePushSubscription(pushSubscription) {
    const token = document
        .querySelector("meta[name=csrf-token]")
        .getAttribute("content");

    fetch("/ajax/update-push-subscription", {
        method: "POST",
        body: JSON.stringify(pushSubscription),
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            "X-CSRF-Token": token,
        },
    }).then((res) => {
        return res.json();
    });
    // .then((res) => {
    //     console.log(res);
    // })
    // .catch((err) => {
    //     console.log(err);
    // });
}

/**
 * send PushSubscription to server with AJAX.
 * @param {object} pushSubscription
 */
function deletePushSubscription(pushSubscription) {
    const token = document
        .querySelector("meta[name=csrf-token]")
        .getAttribute("content");

    fetch("/ajax/delete-push-subscription", {
        method: "DELETE",
        body: JSON.stringify(pushSubscription),
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            "X-CSRF-Token": token,
        },
    }).then((res) => {
        return res.json();
    });
    // .then((res) => {
    //     console.log(res);
    // })
    // .catch((err) => {
    //     console.log(err);
    // });
}

/**
 * urlBase64ToUint8Array
 *
 * @param {string} base64String a public vapid key
 */
function urlBase64ToUint8Array(base64String) {
    var padding = "=".repeat((4 - (base64String.length % 4)) % 4);
    var base64 = (base64String + padding)
        .replace(/\-/g, "+")
        .replace(/_/g, "/");

    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}


let xhr = new XMLHttpRequest();
xhr.open('get', 'https://api.twitch.tv/kraken/streams/?game=League%20of%20Legends&limit=20', true);
xhr.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');
xhr.setRequestHeader('Client-ID', 'ny6wc2vmq495cxmvtd53e4w1khgtzk');
xhr.send(null);
xhr.onload = function () {
    let channel = JSON.parse(xhr.response).streams;
    console.log(channel);
    let streamer_channel = '';
    for (let i = 0; i < channel.length; i++) {
        streamer_channel += `
        <div class="stream">
            <a href="${channel[i].channel.url}"><img class="stream__pic" src="${channel[i].preview.medium}"></a>
            <div class="stream__streamer">
                <img class="stream__streamer__pic" src="${channel[i].channel.logo}">
                <ul class="stream__streamer__detail">
                    <li>${channel[i].channel.status}</li>
                    <li>${channel[i].channel.display_name}</li>
                </ul>
            </div>
        </div>
        `;
    }
    document.querySelector('.content').innerHTML = streamer_channel
}

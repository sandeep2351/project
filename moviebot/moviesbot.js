const TelegramBot = require('node-telegram-bot-api');
const axios = require('axios');
const admin = require('firebase-admin');
const token = '6928133426:AAHHAfBj_2KgpElIoOvjJlWlkDOvs6ggnBY';
const apiKey = '8d95e66';

const serviceAccount = require("./telegrambot401assignment-firebase-adminsdk-xpqlc-09575a7e57.json");

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount)
});

const bot = new TelegramBot(token, {polling: true});
const db = admin.firestore();
const ref = db.collection('movies');

bot.onText(/\/start/, (msg) => {
    bot.sendMessage(msg.chat.id, 'Welcome! to the Movies Bot. Enter Movie Title to search.');
});

bot.on('message', async (msg) => {
    const chatId = msg.chat.id;
    const movieTitle = msg.text;
    try{
        const response = await axios.get(`http://www.omdbapi.com/?t=${encodeURIComponent(movieTitle)}&apikey=${apiKey}`);
        const movieData = response.data;
        if(movieData.Response === "False"){
            bot.sendMessage(chatId, "Movie not found.....");
            return;
        }
        const title = movieData.Title;
        const year = movieData.Year;
        const plot = movieData.Plot;
        const poster = movieData.Poster;
        const message = `Title: ${title}\nYear: ${year}\nPlot: ${plot}\nPoster: ${poster}`;
        bot.sendPhoto(chatId, poster, { caption: message });
        await ref.add({
            title: title,
            year: year,
            plot: plot,
            poster: poster
        });}
    catch (error) {
        console.error("Error:", error);
        bot.sendMessage(chatId, "Failed to fetch the MOVIE Details...");
    }

});


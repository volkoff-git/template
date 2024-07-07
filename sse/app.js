import express from 'express';
import bodyParser from 'body-parser';
import { createServer } from 'http';
import { Server } from 'socket.io';
import path from 'path';



const port = 3000;
const app = express();
const server = createServer();
const io = new Server(server, {
    path: '/sse',
    serveClient: false,
});

// app.use(bodyParser.json({limit: '50mb'}));
// app.use(bodyParser.urlencoded({limit: '50mb', extended: true, parameterLimit: 50000}));



const fooNamespace = io.of('/sse');





io.on('connection', (socket) => {
    console.log('Новое соединение в пространстве имен /sse:', socket.id);

    // Отправка сообщения клиенту после подключения
    socket.emit('message', 'Сообщение из сервера !'+socket.id);

    // Обработка события разрыва соединения
    socket.on('disconnect', (reason) => {
        console.log('Соединение разорвано в пространстве имен /sse:', socket.id);
        console.log('Причина:', reason);
    });
});


// app.get('/sse/test', (req, res) => {
//     res.send('Hello, World!2222');
//     //  res.status(404).json({'result': 'not_authenticated'}); return;
// });

// app.get('/sse', (req, res) => {
//     // Здесь можно отправить что-то клиенту или выполнить другие действия
//     res.send('Hello from /foo');
// });


server.listen(port, () => {
    //console.log(`Server running at http://${HOST}:${port}/`);
});
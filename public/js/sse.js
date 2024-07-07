const socket = io( {
     transports: [ 'websocket'],
     path: '/sse',
    reconnectionAttempts: 1
});


socket.on('connect', () => {
    console.log('Соединение установлено в пространстве имен /sse:', socket.id);
});
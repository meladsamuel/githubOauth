</head>
<body>
<div class="container">
    <?php $messages = $this->messenger->getMessages(); if(!empty($messages)): foreach($messages as $message): ?>
        <div class="alert <?= $message[1] === 'success' ? 'alert-success': 'alert-danger' ?>">
            <?= $message[0] ?>
        </div>
    <?php endforeach; endif; ?>
</div>
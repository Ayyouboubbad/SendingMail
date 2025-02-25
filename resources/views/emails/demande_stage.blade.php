<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Demande de Stage - Développement Web Full Stack</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; background: white; padding: 20px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .header { background: #007bff; color: white; text-align: center; padding: 15px; font-size: 20px; font-weight: bold; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; text-align: justify; }
        .footer { margin-top: 20px; text-align: center; font-size: 14px; color: #666; }
        .btn { display: inline-block; background:rgb(36, 129, 228); color: black; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-top: 10px; }
        .btn:hover { background:rgb(3, 122, 249); }
        .btn-container { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header"><strong>Demande de Stage - Développement Web Full Stack</strong></div>
        <div class="content">
            <p>Bonjour,</p>
            <p>Je me permets de vous adresser ma candidature pour <strong>un stage en développement web full stack </strong> au sein de votre entreprise.</p>
            
            <p>Passionné par le développement, je suis actuellement en formation et je souhaite mettre en pratique mes compétences techniques en participant à des projets réels.</p>
            
            <p>Je reste à votre disposition pour toute information complémentaire et j'espère pouvoir échanger avec vous lors d'un entretien.</p>

            <p>Dans l’attente de votre retour, je vous prie d’agréer, Madame/Monsieur, mes salutations distinguées.</p>

            <div class="btn-container">
                <a href="mailto:{{ $data['email'] }}" class="btn">📩 Répondre à ce message</a>
            </div>
        </div>
        <div class="footer">
            <p>Envoyé par {{ $data['name'] }} - 📧 {{ $data['email'] }} | 📞 {{ $data['phone'] }}</p>
        </div>
    </div>
</body>
</html>

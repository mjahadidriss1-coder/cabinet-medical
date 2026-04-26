# 🏥 Cabinet Médical — Gestion de Rendez-vous

Application web Laravel de gestion de rendez-vous pour cabinet médical.  
Projet CC2 — Module : Développer en back-end | DD 2ème année 2025/2026

---

## ⚙️ Installation

### Prérequis
- PHP >= 8.2
- Composer
- MySQL

### Étapes

```bash
# 1. Cloner le repo
git clone https://github.com/votre-username/cabinet-medical.git
cd cabinet-medical

# 2. Installer les dépendances PHP
composer install

# 3. Copier le fichier d'environnement
cp .env.example .env

# 4. Générer la clé
php artisan key:generate

# 5. Configurer .env
# DB_DATABASE=cabinet_medical
# DB_USERNAME=root
# DB_PASSWORD=votre_mot_de_passe

# 6. Créer la base de données MySQL
mysql -u root -p -e "CREATE DATABASE cabinet_medical CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 7. Migrations + Seeders
php artisan migrate --seed

# 8. Vider les caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 9. Lancer le serveur
php artisan serve
```

Accéder : http://localhost:8000

---

## 🔑 Identifiants par défaut

| Rôle    | Email               | Mot de passe |
|---------|---------------------|--------------|
| Admin   | admin@cabinet.ma    | password     |
| Médecin | medecin@cabinet.ma  | password     |
| Patient | patient@cabinet.ma  | password     |

---

## 🌐 API REST

Base URL : `http://localhost:8000/api`

### Endpoints

| Méthode | Endpoint                 | Description                 |
|---------|--------------------------|-----------------------------|
| GET     | `/api/appointments`      | Lister tous les rendez-vous |
| GET     | `/api/appointments/{id}` | Détail d'un rendez-vous     |
| POST    | `/api/appointments`      | Créer un rendez-vous        |

---

### GET `/api/appointments`

```bash
curl http://localhost:8000/api/appointments
```

Réponse :
```json
{
    "success": true,
    "count": 20,
    "data": [
        {
            "id": 1,
            "patient": { "id": 3, "name": "Mohammed Alami", "email": "patient@cabinet.ma" },
            "medecin": { "id": 2, "name": "Dr. Fatima Benali", "specialite": "Généraliste" },
            "service": { "id": 1, "name": "Consultation générale", "prix": 150 },
            "appointment_date": "2026-05-15",
            "appointment_time": "10:00:00",
            "statut": "confirme",
            "notes": null,
            "created_at": "2025-01-01T10:00:00.000000Z"
        }
    ]
}
```

---

### GET `/api/appointments/{id}`

```bash
curl http://localhost:8000/api/appointments/1
```

Réponse :
```json
{
    "success": true,
    "data": {
        "id": 1,
        "patient": { "id": 3, "name": "Mohammed Alami", "email": "patient@cabinet.ma" },
        "medecin": { "id": 2, "name": "Dr. Fatima Benali", "specialite": "Généraliste" },
        "service": { "id": 1, "name": "Consultation générale", "prix": 150 },
        "appointment_date": "2026-05-15",
        "appointment_time": "10:00:00",
        "statut": "confirme",
        "notes": null,
        "created_at": "2025-01-01T10:00:00.000000Z"
    }
}
```

---

### POST `/api/appointments`

```bash
curl -X POST http://localhost:8000/api/appointments \
  -H "Content-Type: application/json" \
  -d '{
    "patient_id": 3,
    "medecin_id": 2,
    "service_id": 1,
    "appointment_date": "2026-05-20",
    "appointment_time": "09:30",
    "notes": "Première consultation"
  }'
```

Réponse :
```json
{
    "success": true,
    "message": "Rendez-vous créé avec succès.",
    "data": {
        "id": 21,
        "patient": { "id": 3, "name": "Mohammed Alami", "email": "patient@cabinet.ma" },
        "medecin": { "id": 2, "name": "Dr. Fatima Benali", "specialite": "Généraliste" },
        "service": { "id": 1, "name": "Consultation générale", "prix": 150 },
        "appointment_date": "2026-05-20",
        "appointment_time": "09:30:00",
        "statut": "en_attente",
        "notes": "Première consultation",
        "created_at": "2026-05-01T08:00:00.000000Z"
    }
}
```

---

## ✅ Fonctionnalités

- 🔐 Authentification (Login / Register)
- 📅 CRUD complet des rendez-vous
- 👥 Gestion des utilisateurs (patients & médecins) — Admin uniquement
- 🛠️ Gestion des services médicaux
- 🔍 Recherche asynchrone en temps réel (Axios)
- 💬 Modales pour ajout rapide et suppression
- 🌐 Interface bilingue (Français / Arabe — RTL)
- 📧 Email de confirmation automatique
- 🔌 API REST (JSON)
- 🎨 Landing page moderne

---

## 🗂️ Structure du projet

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   │   └── AppointmentApiController.php
│   │   ├── Auth/
│   │   │   ├── LoginController.php
│   │   │   └── RegisterController.php
│   │   ├── AppointmentController.php
│   │   ├── ServiceController.php
│   │   ├── UserController.php
│   │   └── LangController.php
│   └── Middleware/
│       └── SetLocale.php
├── Models/
│   ├── Appointment.php
│   ├── Service.php
│   └── User.php
lang/
├── fr/
│   └── app.php
└── ar/
    └── app.php
resources/
└── views/
    ├── layouts/app.blade.php
    ├── appointments/
    ├── services/
    └── users/
        ├── index.blade.php
        └── partials/
            ├── patients-rows.blade.php
            └── medecins-rows.blade.php
routes/
├── web.php
└── api.php
```

---

## 🛠️ Technologies utilisées

| Technologie  | Version |
|--------------|---------|
| Laravel      | 12      |
| PHP          | 8.2     |
| MySQL        | 8.0+    |
| Bootstrap    | 5.3     |
| Font Awesome | 6.5     |
| Axios        | CDN     |
| Google Fonts | CDN     |

---

## 👨‍💻 Développé par

**DD2 — OFPPT**  
© 2025 Cabinet Médical

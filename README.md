# WorldBlog

Blog platforma napravljena u Laravelu. Podržava objave, kategorije, tagove, komentare i kompletan admin panel za upravljanje sadržajem.



---

### Instalacija

```bash
git clone https://github.com/MihajloZivkovic1/laravelblog.git
cd worldblog

composer install

cp .env.example .env
php artisan key:generate
```

Podesi bazu podataka u `.env` fajlu:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelblog
DB_USERNAME=root
DB_PASSWORD=
```

Pokreni migracije i seedere:

```bash
php artisan migrate:fresh --seed
```
---

## Kredencijali

### Admin
| Polje      | Vrednost          |
|------------|-------------------|
| Email      | admin@blog.com    |
| Lozinka    | password          |
| Uloga      | admin             |

### Obični korisnici
| Ime        | Email          | Lozinka  |
|------------|----------------|----------|
| John Doe   | john@blog.com  | password |
| Jane Smith | jane@blog.com  | password |



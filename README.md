# Apartment Information System 🏢

A comprehensive web-based apartment management system built with HTML, CSS, JavaScript, and PHP/MySQL for college major projects.

## Features

### 🏠 User Panel (Tenant/Resident)
- **Login/Signup** – Secure entry point for account creation and access
- **Apartment Browsing** – View available apartments with details (Block, Floor, Type, Rent)
- **Search & Filter** – Find apartments by type, rent, or location
- **Booking Request** – Submit request to rent apartment
- **Payment** – Pay rent or booking fees via Cash/Card/UPI
- **Maintenance Request** – Raise issues (electricity, plumbing, etc.)
- **Feedback System** – Rate apartment services and give reviews
- **Profile Management** – Update name, email, password, contact details
- **Booking/Payment History** – View past bookings and payments

### 🛠️ Admin Panel (Apartment Manager)
- **Admin Login** – Secure access for apartment management staff
- **Dashboard** – Overview of tenants, bookings, payments, and maintenance requests
- **Apartment Management** – Add, update, delete apartment records
- **Tenant Management** – View tenant profiles and booking history
- **Owner Management** – Manage apartment owners and their properties
- **Booking Management** – Accept, reject, or update booking requests
- **Payment Tracking** – Monitor rent payments and generate bills
- **Maintenance Management** – Track and resolve maintenance requests
- **Feedback Review** – Read and reply to tenant feedback
- **Reports & Analytics** – Generate financial, occupancy, and maintenance reports

## Project Structure

```
Apartment-information-system/
├── index.php                 # Homepage
├── login.php                 # Login page
├── signup.php                # Registration page
├── logout.php                # Logout handler
├── db_config.php             # Database configuration
├── assets/
│   └── style.css             # Main stylesheet
├── admin/                    # Admin panel files
│   ├── dashboard.php
│   ├── apartments.php
│   ├── tenants.php
│   ├── bookings.php
│   ├── payments.php
│   └── maintenance.php
├── tenant/                   # Tenant panel files
│   ├── dashboard.php
│   ├── browse_apartments.php
│   ├── my_bookings.php
│   ├── maintenance.php
│   ├── payments.php
│   └── profile.php
├── database.sql              # Database schema
└── README.md                 # This file
```

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/FearK45/Apartment-information-system.git
   cd Apartment-information-system
   ```

2. **Setup Database**
   - Open phpMyAdmin or MySQL command line
   - Create a new database named `apartment_system`
   - Import `database.sql` file:
     ```bash
     mysql -u root -p apartment_system < database.sql
     ```

3. **Configure Database Connection**
   - Edit `db_config.php` with your database credentials:
     ```php
     $db_host = 'localhost';
     $db_user = 'root';
     $db_password = '';
     $db_name = 'apartment_system';
     ```

4. **Run the Application**
   - Place the project in your web server directory (htdocs for XAMPP)
   - Access via: `http://localhost/Apartment-information-system/`

## Usage

### For Tenants:
1. Sign up with your credentials
2. Login to your dashboard
3. Browse available apartments
4. Submit booking requests
5. Make payments
6. Request maintenance services
7. Update your profile

### For Admin:
1. Login with admin credentials
2. Manage apartments, tenants, and bookings
3. Track payments and maintenance requests
4. Generate reports and analytics
5. Review tenant feedback

## Default Admin Credentials

After importing the database, use these credentials to login as admin:
- **Email**: admin@apartment.com
- **Password**: admin123

(Note: Change these credentials after first login)

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Server**: Apache (XAMPP recommended)

## Database Tables

1. **users** - Tenant/Resident information
2. **admins** - Admin account details
3. **apartments** - Apartment listings
4. **bookings** - Booking requests and history
5. **payments** - Payment records
6. **maintenance** - Maintenance requests
7. **feedback** - Tenant feedback and reviews

## Future Enhancements

- [ ] Email notifications for bookings and payments
- [ ] SMS alerts for maintenance requests
- [ ] Advanced analytics and reports
- [ ] Mobile app version
- [ ] Payment gateway integration (Razorpay, Stripe)
- [ ] Document upload for verification
- [ ] Automated billing system
- [ ] Real-time notifications
- [ ] Google Maps integration

## Security Features

- Password hashing using bcrypt
- SQL injection prevention with prepared statements
- Session-based authentication
- Input validation and sanitization
- CSRF protection

## Contributing

Feel free to fork this project and submit pull requests for any improvements!

## License

This project is open source and available for educational purposes.

## Author

**FearK45** - College Major Project

## Support

For issues or questions, please create an issue on GitHub.

---

**Made with ❤️ for college education**

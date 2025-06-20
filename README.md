# 🏪 Multi-Tenant E-commerce + POS Platform Backend

A Laravel 12-powered backend for a multi-tenant E-commerce and POS platform tailored for **franchise businesses** (e.g., KFC, McDonald’s), supporting **FFL compliance**, **multi-location inventory**, **customer/employee portals**, and **franchise-specific customization**.

---

## 🚀 Project Overview

This platform enables franchises to manage multiple stores with localized settings (inventory, pricing, staff), while maintaining central control and compliance, especially for FFL-regulated products. The backend is **API-driven** and designed for seamless integration with various frontends (React, Vue, mobile apps).

---

## 🎯 Core Features

### ✅ Multi-Franchise & Multi-Location
- Each franchise (e.g., KFC, McDonald's) can have multiple branches.
- Branch-specific inventory, pricing, employees, and branding.

### ✅ Customer Portal (API-ready)
- Product browsing and ordering (e-commerce or in-store).
- Order tracking, profile management, and branded experience.

### ✅ Employee Portal (API-ready)
- Role-based access for managers, cashiers, staff.
- Order processing, customer interaction, and daily operations.

### ✅ Products
- Master product list at franchise level.
- Location-specific overrides (price, availability).
- FFL product support with background checks and ATF 4473 compliance.

### ✅ Orders & Payments
- Unified flow for online and in-store (POS) orders.
- Partial payments and multi-method transactions (cash, card, wallets, gift cards, external deals).

### ✅ Promotions & Deals
- Internal campaigns (coupons, discounts).
- External integration with platforms like **Groupon**.

### ✅ Inventory Management
- Real-time stock tracking at each location.
- Alerts for low-stock, expiry, and reorder thresholds.

### ✅ FFL Compliance
- ATF 4473 digital form support.
- Background check integration and validation flows.

### ✅ Audit Logs
- Track every `create`, `update`, `delete` with actor and timestamp.
- Useful for compliance, support, and rollback logic.

### ✅ Accounting & GL Reporting
- General Ledger with double-entry bookkeeping.
- Accrual & cash-based financial statements.
- P&L, balance sheets, and transaction reports.

---

## ⚙️ Technical Stack

| Layer       | Tech                                    |
|-------------|------------------------------------------|
| **Backend** | Laravel 12 (REST API)                    |
| **Auth**    | JWT-based (Employees & Customers)        |
| **Database**| MySQL 8 with UUID + auto-increment IDs   |
| **Testing** | Seeders and dummy data for CRUD, reports |
| **Frontend**| Not included (API-ready for SPA/Mobile)  |

---

## 🧪 Testing & Dummy Data

- Preloaded dummy records for users, products, orders, etc.
- Ready to validate CRUD flows, access control, and reporting.
- Use `php artisan migrate:fresh --seed` for setup.

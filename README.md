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
| **Auth**    | Personal-Access-based (Employees & Customers)|
| **Database**| MySQL 8 with UUID + auto-increment IDs   |



## 📘 Getting Started

1. Clone the repo  
   git clone https://github.com/JYOTHIKONDUPALLY/Bizzflo_demo_backend.git
   cd Bizzflo_demo_backend
   
2. Install dependencies:
   composer install

3. Configure environment:
    cp .env.example .env 
    php artisan key:generate

4. Setup database:
   php artisan migrate --seed

5. Start development server:
   php artisan serve

   # ✅ Milestone Plan: Backend API Development (4 Weeks)

---

## 📅 Week 1: Core Setup + Auth + Multi-tenancy (40 hrs)

| Task                                                                 | Hours |
|----------------------------------------------------------------------|--------|
| Laravel 12 project setup & tenant scaffolding (domains, middleware) | 8 hrs  |
| Auth system with JWT (Customers & Employees)                        | 10 hrs |
| Role & Permission middleware setup (Policies/Gates or Spatie Roles) | 6 hrs  |
| Seeders for dummy users (franchise owners, staff, customers)        | 4 hrs  |
| Product master module (CRUD at franchise level)                     | 8 hrs  |
| Swagger + Postman setup for Auth & Products                         | 4 hrs  |

**Deliverables:**
- ✅ Working auth (multi-guard)
- ✅ Tenant recognition (middleware or subdomain-based)
- ✅ Product master API
- ✅ Swagger/Postman for auth + products

---

## 📅 Week 2: Orders + Inventory + Customer APIs (40 hrs)

| Task                                                      | Hours |
|-----------------------------------------------------------|--------|
| Order API: POS + online unified structure                 | 12 hrs |
| Customer cart + checkout APIs                             | 6 hrs  |
| Payment flow setup (multi-method, cash/card/gift/etc.)    | 6 hrs  |
| Location-wise inventory model + APIs                      | 8 hrs  |
| Customer portal APIs (orders, profile, status tracking)   | 6 hrs  |
| Swagger + Postman for Orders + Inventory                  | 2 hrs  |

**Deliverables:**
- ✅ End-to-end order flow (create, update status)
- ✅ Inventory sync per location
- ✅ Customer-side API endpoints
- ✅ Order and inventory docs in Swagger/Postman

---

## 📅 Week 3: Promotions + Employee Portal + Audit Logs (40 hrs)

| Task                                                         | Hours |
|--------------------------------------------------------------|--------|
| Internal/external promotions logic (e.g., coupons, Groupon)  | 6 hrs  |
| Apply promo rules to cart/order                              | 4 hrs  |
| Employee APIs (order manage, product stock update, etc.)     | 8 hrs  |
| Audit logs with actor tracking (create, update, delete)      | 8 hrs  |
| Basic reporting endpoints (sales summary, stock alerts)      | 6 hrs  |
| Swagger + Postman for Promos, Employees, Reports             | 4 hrs  |
| Testing & fix round 1                                        | 4 hrs  |

**Deliverables:**
- ✅ Promotions + deals engine
- ✅ Employee panel API ready
- ✅ Logging with model observers or DB-based audit
- ✅ Reporting prototype

---

## 📅 Week 4: GL Accounting + Final QA + Docs (40 hrs)

| Task                                                      | Hours |
|-----------------------------------------------------------|--------|
| GL Engine (transaction model, account categories)         | 12 hrs |
| Bookkeeping entries for orders, refunds, etc.             | 6 hrs  |
| Financial APIs (P&L, balance sheet, ledger exports)       | 6 hrs  |
| Final QA testing + seed real-world data                   | 6 hrs  |
| Finalize Swagger documentation & Postman export           | 6 hrs  |
| Developer handoff docs or API usage notes                 | 4 hrs  |

**Deliverables:**
- ✅ Financial module MVP
- ✅ Fully tested API with seed data
- ✅ Final docs (Swagger, Postman, usage notes)

---

## ✅ Summary

| Milestone                | Hours  | Key Deliverables                                      |
|--------------------------|--------|--------------------------------------------------------|
| Week 1: Setup + Auth      | 40 hrs | Auth, Tenant flow, Product Master                      |
| Week 2: Orders + Inventory| 40 hrs | Orders, Inventory, Customer APIs                       |
| Week 3: Promos + Audit    | 40 hrs | Promotions, Employee APIs, Audit Logs, Reports         |
| Week 4: GL + QA + Docs    | 40 hrs | GL Accounting, Swagger, Postman, Final API polishing   |




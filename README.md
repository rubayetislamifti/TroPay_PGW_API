# 🏦 TroPay API Documentation

## 📘 Introduction
**TroPay** is developed by **TrodevIT** — a simple, secure, and unified **payment gateway API**.  
It allows you to integrate **bKash**, **Nagad**, **Rocket**, or other local payment systems with your web or mobile applications.

After creating an account, you will receive your unique:
- **App Key**
- **App Secret**

These credentials are required for authentication.

---

## 🌐 Base URL
```
{baseURL}
```

> You will get your **baseURL** after TroPay provides your account credentials.

---

## 🔑 Required Headers

| Header Name | Description | Example |
|--------------|-------------|----------|
| `App-Key` | Your unique App Key | `Rubayet_Islam` |
| `App-Secret` | Your unique App Secret | `Rubayet_Islam2025` |

> Both headers are **required** for every API call.

---

## 💰 Create Payment

**Endpoint**
```
POST {baseURL}/api/payment
```

### 📄 Description
Initialize a new payment with TroPay.

### 🧾 Request Body (Form Data)

| Parameter   | Type   | Required | Description                 | Example       |
|-------------|--------|----------|-----------------------------|---------------|
| `amount`    | number | ✅        | The payment amount          | `1`           |
| `reference` | string | ✅        | Customer or order reference | `01642889275` |

### 🧠 Example Request
```bash
curl -X POST {baseURL}/api/payment \
-H "App-Key: Rubayet_Islam" \
-H "App-Secret: Rubayet_Islam2025" \
-F "amount=1" \
-F "reference=01642889275"
```

### ✅ Example Response
```json
{
  "success": true,
  "payment_url": "https://example.tropay.com/checkout/abc123"
}
```

---

## 🔍 Verify Payment

**Endpoint**
```
POST {baseURL}/api/payment/verify
```

### 📄 Description
Use this endpoint to verify the status of a payment after initialization.

### 🧾 Request Body (Form Data)

| Parameter | Type | Required | Description | Example |
|------------|------|-----------|--------------|----------|
| `agreementID` | string | ✅ | The unique agreement/payment ID | `TrodevOLB57RV1759686645570` |

### 🧠 Example Request
```bash
curl -X POST {baseURL}/api/payment/verify \
-H "App-Key: Rubayet_Islam" \
-H "App-Secret: Rubayet_Islam2025" \
-F "agreementID=TrodevOLB57RV1759686645570"
```

### ✅ Example Response
```json
{
  "success": true,
  "status": "Completed",
  "transaction_id": "TX12345ABC",
  "amount": "1.00",
  "reference": "01642889275"
}
```

---

## ⚙️ Environment Variable

| Key | Description |
|------|-------------|
| `baseURL` | The root URL of your API (production or sandbox) |

You can define this variable in Postman or your `.env` file.

---

## 🧩 Summary

| Action | Method | Endpoint | Purpose |
|--------|---------|-----------|----------|
| Create Payment | `POST` | `/api/payment` | Initialize new payment |
| Verify Payment | `POST` | `/api/payment/verify` | Verify payment status |

---

## 👨‍💻 Developed by
**TrodevIT**  
📧 [support@trodevit.com](mailto:support@trodevit.com)  
🌐 [www.trodevit.com](https://www.trodevit.com)

---

"use strict";

require("dotenv").config();
const express = require("express");
const app = express();
const cors = require("cors");
const router = express.Router();
const routes = require("./routes/index");
const path = require("path");

const port = process.env.PORT || 3999;

// Parse Data
app.use(express.json({ extended: true }));
app.use(express.urlencoded({ extended: true }));

// Dev Logginf Middleware
app.use(cors());

// Set Base path with api
app.use("/api/", routes(router));

//for errors
app.use((error, req, res, next) => {
  if (!error) {
    return next();
  }
  console.error(error);
  res.status(500).send({
    status: 0,
    message: "Global Error: " + error.message,
  });
});

// Public static folder to host images.
app.use(express.static(path.join(__dirname, "public")));

// Start the Port
app.listen(port, () => {
  console.log("Server connected on", port);
});

"use strict";

const message = {
  200: {
    message: "Success",
    httpCode: 200,
    status: 1,
  },
  400: {
    message: "Failure",
    httpCode: 400,
    status: 0,
  },
  455: {
    message: "Error: No code was passed in helper.",
    httpCode: 455,
    status: 0,
  },
  501: {
    message: "Database Error",
    httpCode: 501,
    status: 0,
  },
  502: {
    message: "You are not authorized to perform this action.",
    httpCode: 502,
    status: 0,
  },
  503: {
    message: "JWT Error.",
    httpCode: 503,
    status: 0,
  },
  505: {
    message: "Error Caught.",
    httpCode: 505,
    status: 0,
  },
  509: {
    message: "Error from Image SDK",
    httpCode: 505,
    status: 0,
  },
  1000: {
    message: "Email sent.",
    httpCode: 200,
    status: 1,
  },
  1001: {
    message: "Unable to send mail.",
    httpCode: 400,
    status: 0,
  },
};

module.exports = message;

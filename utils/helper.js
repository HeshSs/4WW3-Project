"use strict";
const helper = {
  send: async (res, response) => {
    let result = {};
    const code = response.code ? response.code : 455;
    const data = response.data ? response.data : null;
    const msg = response.msg ? response.msg : null;

    var m = require("./msgs")[code];
    result.status = m ? m.status : code;
    result.message = msg ? msg : m ? m.message : "";
    result.data = data ? data : "";
    // console.log(result);
    res.status(m ? m.httpCode : 280).json(result);
  },
};

module.exports = helper;

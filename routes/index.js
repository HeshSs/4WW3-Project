const s3 = require("../features/s3/s3.routes");

module.exports = (router) => {
  s3(router);
  return router;
};

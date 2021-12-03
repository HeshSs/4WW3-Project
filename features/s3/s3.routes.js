const { s3AddImage } = require("./s3.controller");
const Uploader = require("../../utils/imageUpload");
const upload = Uploader();

module.exports = (router) => {
  router.post("/upload/image", [upload.single("image")], s3AddImage);
};

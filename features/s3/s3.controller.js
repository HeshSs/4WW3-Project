"use strict";
const { send } = require("../../utils/helper");
const AWS = require("aws-sdk");

const s3Client = new AWS.S3({
  accessKeyId: process.env.AWS_ACCESS_KEY_ID,
  secretAccessKey: process.env.AWS_SECRET_ACCESS_KEY,
  region: process.env.AWS_REGION,
});

const postController = {
  s3AddImage: async (req, res, next) => {
    try {
      let resp = {};
      if (req.file && req.file.originalname) {
        s3Client.upload(
          {
            Bucket: process.env.AWS_BUCKET,
            Key: `imgs/${process.env.FOLDER}/${Date.now() + req.file.originalname}`, // pass key filename
            Body: req.file.buffer, // pass file body
          },
          (error, result) => {
            if (error) {
              resp.code = 500;
              resp.msg = error;
              send(res, resp);
            } else {
              resp.code = 200;
              resp.msg = "File was uploaded.";
              resp.data = result;
              send(res, resp);
            }
          }
        );
      } else {
        resp.code = 500;
        resp.msg = "Didn't receive an image.";
        send(res, resp);
      }
    } catch (error) {
      next(error);
    }
  },
};

module.exports = postController;

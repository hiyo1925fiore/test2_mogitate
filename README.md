# mogitate（もぎたて）
## 環境構築
**Dockerビルド**
1. `git clone git@github.com:hiyo1925fiore/test2_mogitate.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d build`
> MacのM1・M2チップのPCの場合、no matching manifest for linux/arm64/v8 in the manifest list entriesのメッセージが表示されビルドができないことがあります。 エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加で記載してください
```
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```

![database2 drawio](https://github.com/user-attachments/assets/41745a03-f6a3-4001-b5e0-113b113d2468)

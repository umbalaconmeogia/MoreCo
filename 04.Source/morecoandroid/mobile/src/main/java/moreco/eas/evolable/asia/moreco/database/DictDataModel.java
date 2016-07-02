package moreco.eas.evolable.asia.moreco.database;

import io.realm.RealmObject;
import io.realm.annotations.Ignore;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class DictDataModel extends RealmObject {
    private String version;
    private int versionId;

    @Ignore
    private int sessionId;

    public int getVersionId() {
        return versionId;
    }

    public void setVersionId(int versionId) {
        this.versionId = versionId;
    }

    public String getVersion() {
        return version;
    }

    public void setVersion(String version) {
        this.version = version;
    }


}
